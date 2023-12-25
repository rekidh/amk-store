<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\CleanSpecialCharsTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Customers;
use App\Models\Items;
use App\Models\Orders;
use App\Models\OrderItems;

class OrdersController extends Controller
{
    use CleanSpecialCharsTrait;


    function index(Request $request)
    {
        $userID = $request->input('user');
        $items = Items::select('uuid', 'name', 'price', 'description', 'category_id')->with(['category'])->take(30)->get();

        if (!$userID) {
            $customer = Customers::latest()->first();
            if (!$customer) {
                return view('pages.content.order.index')->with([
                    'customers' => [],
                    'currentCustomer' => [],
                    'orderItems' => [],
                    'products' => $items
                ]);
            }
            $userID = $customer->uuid;
        } else {
            $customer = Customers::where('uuid', $this->cleanSpecialChars($userID))->first();
            if (!$customer) {
                return redirect()->route('orderProductList')->with('error', 'User not found');
            }
        }
        $orderItems = Orders::where('customer_id', $userID)->with('orderItems.item')->get();
        $customers = Customers::select('name', 'uuid')->orderBy('created_at', 'desc')->take(30)->get();

        return view('pages.content.order.index')->with([
            'customers' => $customers,
            'currentCustomer' => $customer,
            'orderItems' => $orderItems,
            'products' => $items
        ]);
    }

    //++++++++++++++++++++++++++++++++ADD NEW CUSTOMER AND CRETE ORDER ++++++++++++++++++++++++++++++++++++++++++++++++
    function submitCustomer(Request $request)
    {
        DB::beginTransaction();

        try {
            $customer = new Customers([
                'name' => $this->cleanSpecialChars($request->name),
                'address' => $this->cleanSpecialChars($request->address),
                'phone' => $this->cleanSpecialChars($request->phone),
            ]);

            if (!$customer->save()) {
                DB::rollBack();
                return response()->json(['message' => 'Failed to add customer']);
            }

            $order = new Orders([
                'customer_id' => $customer->uuid,
                'code' => date('ymdHis'),
                'date' => now(),
                'address' => $this->cleanSpecialChars($request->address),
                'subtotal' => 0,
                'discount' => 0,
                'total' => 0,
            ]);

            if (!$order->save()) {
                DB::rollBack();
                return response()->json(['message' => 'Failed to add order']);
            }

            DB::commit();

            return response()->json(['message' => 'Added customer and order successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => 'Error adding customer and order']);
        }
    }
    //++++++++++++++++++++++++++++++++ADD ITEMS TO ORDER LIST++++++++++++++++++++++++++++++++++++++++++++++++
    function submitOrderItem(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'amount' => 'required|numeric|min:1',
                'product_id' => 'required',
                'user_id' => 'required',
            ]);

            $discount = $this->parseDiscount($request->discount);
            $qty = $this->cleanedPrice($request->amount);

            $product = Items::find($request->product_id);
            $customerOrder = Orders::where('customer_id', $request->user_id)->first();

            $orderItem = new OrderItems([
                'order_id' => $customerOrder->uuid,
                'item_id' => $product->uuid,
                'qty' => $qty,
                'price' => $this->cleanedPrice($product->price),
                'discount' => $discount,
                'total' => $this->calculateTotal($product->price, $qty, $this->parseDiscount($discount)),
                'note' => $this->cleanSpecialChars($request->note),
            ]);

            if (!$orderItem->save()) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Failed to add Order Item');
            }
            $orderItems = OrderItems::where('order_id', $customerOrder->uuid)->get();

            $subtotal = $customerOrder->subtotal = $orderItems->sum('total');
            $customerOrder->total = ($customerOrder->discount / 100) * $subtotal;

            if (!$customerOrder->save()) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Failed to update Order');
            }

            DB::commit();

            return redirect()->back()->with('success', 'Added Order Item successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error adding Order Item. Items minimum 1');
        }
    }
    //++++++++++++++++++++++++++++++++DELETE ITEMS IN ORDER LIST++++++++++++++++++++++++++++++++++++++++++++++++
    public function deleteOrderItem($orderItemId)
    {
        DB::beginTransaction();

        try {
            $orderItem = OrderItems::findOrFail($orderItemId);

            if (!$orderItem->delete()) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Failed to delete Order Item');
            }

            $customerOrder = Orders::find($orderItem->order_id);
            $orderItemsTotal = $customerOrder->orderItems()->sum('total');
            $customerOrder->subtotal = $orderItemsTotal;


            if (!$customerOrder->save()) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Failed to update Order');
            }

            DB::commit();

            return redirect()->back()->with('success', 'Deleted Order Item successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error deleting Order Item');
        }
    }
    //++++++++++++++++++++++++++++++++DELETE ORDER ++++++++++++++++++++++++++++++++++++++++++++++++
    // public function deleteOrder($uuid)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $order = Orders::where('uuid', $uuid)->first();
    //         $customer = Customers::where('uuid', $uuid)->first();

    //         if (!$order && !$customer) {
    //             DB::rollBack();
    //             return redirect()->back()->with('error', 'Order not found');
    //         }

    //         $order->orderItems()->delete();
    //         $order->customer()->delete();

    //         if (!$order->delete()) {
    //             DB::rollBack();
    //             return redirect()->back()->with('error', 'Failed to delete order');
    //         }

    //         DB::commit();

    //         return redirect()->route('orderProductList')->with('success', 'Order and associated data deleted successfully');
    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         return redirect()->route('orderProductList')->with('error', 'Error deleting order');
    //     }
    // }
    public function deleteOrder($uuid)
    {
        DB::beginTransaction();

        try {
            $order = Orders::where('uuid', $uuid)->first();

            if (!$order) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Order not found');
            }

            $customer = $order->customer;

            $order->orderItems()->delete();

            if (!$order->delete()) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Failed to delete order');
            }
            if ($customer) {
                $customer->delete();
            }

            DB::commit();

            return redirect()->route('orderProductList')->with('success', 'Order and associated data deleted successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('orderProductList')->with('error', 'Error deleting order');
        }
    }
    //++++++++++++++++++++++++++++++++END TRANSACTION++++++++++++++++++++++++++++++++++++++++++++++++

    function submitOrder(Request $request, $uuid)
    {
        $request->validate([
            'discount' => 'nullable|string|min:0|max:100',
        ]);

        $order = Orders::find($uuid);

        if (!$order) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan');
        }
        if ($request->filled('discount')) {
            $order->discount = $this->parseDiscount($request->input('discount'));
            $order->total = $order->subtotal - (($order->discount / 100) * $order->subtotal);
        } else {
            $order->total = $order->subtotal;
        }

        if ($order->save()) {
            return redirect()->back()->with('success', 'Pesanan berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui pesanan');
        }
    }

    //++++++++++++++++++++++++++++++++API LIST CUSTOMER ++++++++++++++++++++++++++++++++++++++++++++++++
    function listCustomer(Request $request) //api call
    {
        $today = Carbon::today();
        $customers = Customers::whereDate('created_at', $today)->select('name', 'uuid')->get();
        return response()->json($customers);
    }
    //++++++++++++++++++++++++++++++++API LIST PRODUCT++++++++++++++++++++++++++++++++++++++++++++++++
    function apiProduct(Request $request) //api call
    {
        $searchTerm = $this->cleanSpecialChars($request->search);
        if (!$searchTerm == '') {
            $searchProducts = Items::select('uuid', 'name', 'price', 'description', 'category_id')
                ->where(function ($query) use ($searchTerm) {
                    $query->where('name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('price', 'like', '%' . $searchTerm . '%')
                        ->orWhere('description', 'like', '%' . $searchTerm . '%')
                        ->orWhereHas('category', function ($subquery) use ($searchTerm) {
                            $subquery->where('name', 'like', '%' . $searchTerm . '%');
                        });
                })
                ->with(['category'])
                ->take(30)->get();
        } else {
            $searchProducts = Items::select('uuid', 'name', 'price', 'description', 'category_id')->with(['category'])->take(30)->get();
        }
        return response()->json($searchProducts);
    }
    //++++++++++++++++++++++++++++++++HELPER++++++++++++++++++++++++++++++++++++++++++++++++
    private function parseDiscount($discount)
    {
        return max(0, min(100, (float) str_replace('%', '', $discount)));
    }

    private function calculateTotal($price, $qty, $discount)
    {
        $subtotal = $price * $qty;
        $discountAmount = ($discount / 100) * $subtotal;
        return $subtotal - $discountAmount;
    }
}
