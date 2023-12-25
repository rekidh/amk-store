@extends('pages.dashboard')

@section('content')
<div class="grid grid-cols-6 gap-4 mx-2">
   <div class="col-start-1 col-end-5  my-2 ">
      <div class="relative flex flex-row justify-end rounded gap-6 bg-white p-3 shadow-sm  ring-1 ring-gray-900/5 ">

         <div class="text-center">
         <form action="{{ route('deleteOrder', $orderItems ? $orderItems[0]->uuid : 'defaultValue') }}" method="post"  >
            @csrf
            @method('DELETE')

            <button type="submit"  class="rounded-full bg-red-400 px-5 py-3 text-base  font-medium text-white transition duration-200 hover:bg-red-600 active:bg-red-700">
               Remove Order
            </button>
         </form>
         </div>
         <div class="text-center">
            <button id="add-order" onclick="toggleModal('modal-order')"  class="rounded-full bg-blue-500 px-5 py-3 text-base  font-medium text-white transition duration-200 hover:bg-blue-600 active:bg-blue-700">
               Add Order
            </button>
         </div>
         <div id="add-customer" onclick="toggleModal('modal-customer')" class="text-center">
            <button class="rounded-full bg-blue-500 px-5 py-3 text-base  font-medium text-white transition duration-200 hover:bg-blue-600 active:bg-blue-700">
               Add Customer
            </button>
         </div>
      </div>
   <div class="my-5">
      <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md ">
         <table class="w-full bg-white text-left text-sm text-gray-500">
            <input type="hidden" current-user="{{ optional($currentCustomer)->uuid }}" >
            <thead class="bg-gray-50">
               <tr>
                  <th scope="col" class="px-6 py-4 font-medium text-gray-900 min-w-[150px]">List Items</th>
                  <th scope="col" class="px-6 py-4 font-medium text-gray-900 min-w-[150px]">Qty</th>
                  <th scope="col" class="px-6 py-4 font-medium text-gray-900 min-w-[150px]">Discount</th>
                  <th scope="col" class="px-6 py-4 font-medium text-gray-900 min-w-[150px]">Price </th>
                  <th scope="col" class="px-6 py-4 font-medium text-gray-900 min-w-[50px]"></th>
               </tr>
            </thead>
            <tbody class=" divide-gray-100 border-t border-gray-100">
               @forelse ($orderItems as $order)
                  @forelse ($order->orderItems as $orderItem)
                     <tr class="hover:bg-gray-50">
                     <td class="min-w-[150px] px-6 py-4 font-medium text-gray-700 ">{{$orderItem->item->name}}</td>
                     <td class="min-w-[150px] px-6 py-4 font-medium text-gray-700 ">{{$orderItem->qty}}</td>
                     <td class="min-w-[150px] px-6 py-4 font-medium text-gray-700 ">{{number_format($orderItem->discount, 2, '.', ',')}}%</td>
                     <td class="min-w-[150px] px-6 py-4 font-medium text-gray-700 ">Rp.{{number_format($orderItem->total, 2, '.', ',') }}</td>
                     <td class="px-6 py-4">
                        <div class="flex justify-end gap-4">
                           <form action="{{route('deleteOrderItem',optional($orderItems[0])->uuid)}}" method="post"  >
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="group">
                                 <svg xmlns="http://www.w3.org/2000/svg" fill="none"  viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip">
                                    <path class="stroke-red-400 group-hover:stroke-red-600" stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                 </svg>
                              </button>
                           </form>
                        </div>
                     </td>
                     </tr>
                  @endforeach
               @endforeach
            </tbody>
         </table>

         <div class="flex flex-col justify-end w-full gap-3 bg-white border-t border-t-2 border-dashed">
            <div class="w-full flex justify-end">
               <form action="{{route('submitOrder', $orderItems ? $orderItems[0]->uuid: 'defaultValue')}}" method="POST" class="my-5 px-5  ">
                  @csrf
                  @method('POST')
                  <input id="discount" name="discount"  type="text" class="peer h-10 font-normal  border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Add Dicount Order/ %" />
                  <button class="rounded-full bg-blue-500 px-5 py-3 text-base  font-medium text-white transition duration-200 hover:bg-blue-700 active:bg-red-700">
                     Proses Order
                  </button>
               </form>
            </div>
         </div>

      </div>
   </div>
      <!-- component add items -->
   <div id='modal-order' class=" relative  hidden flex items-center justify-center max-w-screen max-h-screen">
      <div  class="fixed inset-0 transition-opacity z-20">
         <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
      </div>
      <a 
         class="close-modal fixed top-0 right-0 p-2 px-5 text-white z-20">
         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
         <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
         </svg>
      </a>
      <div class=" text-center top-8 fixed z-20 ml-[16%] w-[70%]">
         <div class="flex flex-col gap-2 py-16 px-7 rounded-md bg-white">
            <div class="w-[1/4] flex flex-cols justify-end">
               <div class="relative mx-auto ">
                  <input type="search" id="search" name="search" class="peer cursor-pointer relative z-10 h-12 w-12 rounded-full border bg-transparent pl-12 outline-none focus:w-full focus:cursor-text focus:border-sky-400 focus:pl-16 focus:pr-4" />
                  <svg xmlns="http://www.w3.org/2000/svg" class="absolute inset-y-0 my-auto h-8 w-12 border-r border-transparent stroke-gray-500 px-3.5 peer-focus:border-sky-400 peer-focus:stroke-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                  </svg>
               </div>
            </div>
            <div class=" overflow-y-auto max-h-[30em] mt-5 ">
               <!-- List Group -->
               <ul id="listProduct" class="mt-3 px-1 flex flex-col">
                   @forelse ($products as $product)
                     <li class="inline-flex border-solid border-2 border-gray-200 items-center gap-x-2 py-3 px-4 text-sm border text-blue-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg ">
                        <div class="flex items-center justify-between w-full">
                           <span class="font-semibold min-w-[8em] text-start ">{{$product->name}}</span>
                           <span class="font-semibold min-w-[8em] text-start">Rp.{{number_format($product->price, 2, '.', ',') }}</span>
                           <span class="font-semibold min-w-[8em] text-start">{{$product->category->name}}</span>
                           <form method="POST" action="{{route('submitOrderItem')}}" class="flex justify-center items-center  gap-4 ">
                           @csrf
                           @method('POST')
                           <input id="note" name="note" type="text" class="peer h-10 border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Note" />
                           <input id="discount" name="discount" type="text" class="peer h-10 w-[5em] border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Dicount/ %" />
                           <div class="py-2 px-3 inline-block border border-gray-200 rounded-lg  " >
                              <div class="flex items-center gap-x-1.5">
                                 <button type="button" decrement class="w-6 h-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none " >
                                    <svg class="flex-shrink-0 w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/></svg>
                                 </button>
                                 <input id="amount" name="amount" class="p-0 w-6 bg-transparent border-0 text-gray-800 text-center focus:ring-0 " type="text" value="0">
                                 <button  increment type="button" class="w-6 h-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none " >
                                    <svg class="flex-shrink-0 w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                                 </button>
                              </div>
                           </div>

                           <input type="hidden" name="product_id" value="{{$product->uuid}}">
                           <input type="hidden" name="user_id" value="{{optional($currentCustomer)->uuid}}">
                              <button class="rounded-full bg-blue-700 w-6 h-6 p-1 text-white flex items-center">

                                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4  h-4 m-auto" >
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                 </svg>

                              </button>
                           </form>
                        </div>
                     </li>
                  @endforeach
               </ul>
               <!-- End List Group -->
            </div>
         </div>
      </div>
   </div>
      <!-- component add customer -->
   <div id='modal-customer' class=" hidden flex items-center justify-center max-w-screen max-h-screen ">
      <div  class="fixed inset-0 transition-opacity z-20">
         <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
      </div>
      <a 
         class="close-modal fixed top-0 right-0 p-2 px-5 text-white z-20">
         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
         <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
         </svg>
      </a>
      <div class=" text-center top-8 fixed z-20 ml-[16%]">
         <div class="flex flex-col gap-2 py-16 px-7 rounded-md bg-white">
            <div class="w-[1/4]">
               <form class=""  method="POST"  action="{{route('submitCustomer')}}">
                  @csrf
                  @method('POST')
                  <div class="grid md:grid-cols-4 grid-cols- gap-4">
                     <div class="md:col-span-4 ">
                        <input type="text" id="name" name="name" placeholder="Name" value="" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-700">
                     </div>
                     <div class="md:col-span-2">
                        <input type="text" id="address" name="address" placeholder="Address" value="" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-700">
                     </div>
                     <div class="md:col-span-2">
                        <input type="text" id="phone" name="phone" placeholder="Phone" value="" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-700">
                     </div>
                     <div class="md:col-span-4">
                        <button id="submit" type="button" class="py-3 text-base font-medium rounded text-white bg-blue-800 w-full hover:bg-blue-700 transition duration-300">Submit</button>
                     </div>
                  </div>
               </form>
            </div>
            <div class=" overflow-y-auto max-h-[30em] mt-5 ">
               <!-- List Group -->
               <ul id="listCustomer" class="mt-3 px-1 flex flex-col">
                   @foreach ($customers as $customer)
                     <li class="inline-flex border-solid border-2 border-gray-200 items-center gap-x-2 py-3 px-4 text-sm border text-blue-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg ">
                        <div class="flex items-center justify-between w-full">
                           <span class="font-semibold ">{{$customer->name}}</span>
                           <a href="{{route('orderProductList',['user'=> $customer->uuid])}}" class="rounded-full bg-blue-700 w-[2em] h-[2em] text-white">
                              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path class="stroke-gray-200" d="M6 12H18M12 6V18" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>
                           </a>
                        </div>
                     </li>
                  @endforeach
               </ul>
               <!-- End List Group -->
            </div>
         </div>
      </div>
   </div>
      <!-- component struk -->
   </div>
      <div class="col-start-5 col-end-7 bg-gray-600 h-screen">
         <!-- component -->
         @forelse ($orderItems as $order)
            <div class="w-[90%] h-[90%] rounded bg-gray-50 px-6 pt-8 shadow-lg m-auto mt-10 ">
               <img src="https://upload.wikimedia.org/wikipedia/commons/d/d5/Tailwind_CSS_Logo.svg" alt="chippz" class="mx-auto w-16 py-4" />
               <div class="flex flex-col justify-center items-center gap-2">
                  <h4 class="font-semibold">{{ config('app.name', 'Laravel') }}</h4>
                  <p class="text-xs flex flex-col justify-center"> 
                     <span class=" text-center">{{ $order->date }}</span> 
                     <span >{{ $order->address }}</span>
                  </p>
               </div>
               <div class="flex flex-col gap-3 border-b py-6 text-xs">
                  <p class="flex justify-between">
                     <span class="text-gray-400">Transaction Code:</span>
                     <span>{{ $order->code }}</span>
                  </p>
                  <p class="flex justify-between">
                     <span class="text-gray-400">Host:</span>
                     <span>{{auth()->user()->userName}}</span>
                  </p>
                  <p class="flex justify-between">
                     <span class="text-gray-400">Customer:</span>
                     <span>{{optional($currentCustomer)->name}}</span>
                  </p>
               </div>
               <div class="flex flex-col gap-3 pb-6 pt-2 text-xs">
                  <table class="w-full text-left ">
                     <thead>
                        <tr class="flex justify-between ">
                           <th class="py-2">Product</th>
                           <th class="flex w-[35%] justify-between">
                              <span class="py-2">QTY</span>
                              <span class="py-2">Total</span>
                           </th>
                        </tr>
                     </thead>
                     <tbody>
                        @forelse ($order->orderItems as $orderItem)
                        <tr class="flex justify-between">
                           <td class="py-1">{{$orderItem->item->name}}</td>
                           <td class="flex w-[35%] justify-between">
                              <span class="py-1">{{$orderItem->qty}}</span>
                              <span class="py-1">Rp.{{number_format($orderItem->total, 2, '.', ',') }}</span>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                     <tfoot class=" border-t border-t-1 border-dashed">
                        <tr class=" flex justify-between">
                           <th>Subtotal</th>
                           <td>Rp.{{number_format($order->subtotal, 2, '.', ',') }}</td>
                        </tr>
                        <tr class=" flex justify-between">
                           <th>Discount</th>
                           <td>- {{number_format($order->discount, 2, '.', ',') }}%</td>
                        </tr>
                        <tr class=" flex justify-between">
                           <th>Total</th>
                           <td>Rp.{{number_format($order->total, 2, '.', ',') }}</td>
                        </tr>
                     </tfoot>
                  </table>
                  <div class=" border-b border border-dashed"></div>
                  <div class="py-4 justify-center items-center flex flex-col gap-2">
                     <p class="flex gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M21.3 12.23h-3.48c-.98 0-1.85.54-2.29 1.42l-.84 1.66c-.2.4-.6.65-1.04.65h-3.28c-.31 0-.75-.07-1.04-.65l-.84-1.65a2.567 2.567 0 0 0-2.29-1.42H2.7c-.39 0-.7.31-.7.7v3.26C2 19.83 4.18 22 7.82 22h8.38c3.43 0 5.54-1.88 5.8-5.22v-3.85c0-.38-.31-.7-.7-.7ZM12.75 2c0-.41-.34-.75-.75-.75s-.75.34-.75.75v2h1.5V2Z" fill="#000"></path><path d="M22 9.81v1.04a2.06 2.06 0 0 0-.7-.12h-3.48c-1.55 0-2.94.86-3.63 2.24l-.75 1.48h-2.86l-.75-1.47a4.026 4.026 0 0 0-3.63-2.25H2.7c-.24 0-.48.04-.7.12V9.81C2 6.17 4.17 4 7.81 4h3.44v3.19l-.72-.72a.754.754 0 0 0-1.06 0c-.29.29-.29.77 0 1.06l2 2c.01.01.02.01.02.02a.753.753 0 0 0 .51.2c.1 0 .19-.02.28-.06.09-.03.18-.09.25-.16l2-2c.29-.29.29-.77 0-1.06a.754.754 0 0 0-1.06 0l-.72.72V4h3.44C19.83 4 22 6.17 22 9.81Z" fill="#000"></path>
                        </svg>
                        admin@amkstore.com
                     </p>
                     <p class="flex gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"><path fill="#000" d="M11.05 14.95L9.2 16.8c-.39.39-1.01.39-1.41.01-.11-.11-.22-.21-.33-.32a28.414 28.414 0 01-2.79-3.27c-.82-1.14-1.48-2.28-1.96-3.41C2.24 8.67 2 7.58 2 6.54c0-.68.12-1.33.36-1.93.24-.61.62-1.17 1.15-1.67C4.15 2.31 4.85 2 5.59 2c.28 0 .56.06.81.18.26.12.49.3.67.56l2.32 3.27c.18.25.31.48.4.7.09.21.14.42.14.61 0 .24-.07.48-.21.71-.13.23-.32.47-.56.71l-.76.79c-.11.11-.16.24-.16.4 0 .08.01.15.03.23.03.08.06.14.08.2.18.33.49.76.93 1.28.45.52.93 1.05 1.45 1.58.1.1.21.2.31.3.4.39.41 1.03.01 1.43zM21.97 18.33a2.54 2.54 0 01-.25 1.09c-.17.36-.39.7-.68 1.02-.49.54-1.03.93-1.64 1.18-.01 0-.02.01-.03.01-.59.24-1.23.37-1.92.37-1.02 0-2.11-.24-3.26-.73s-2.3-1.15-3.44-1.98c-.39-.29-.78-.58-1.15-.89l3.27-3.27c.28.21.53.37.74.48.05.02.11.05.18.08.08.03.16.04.25.04.17 0 .3-.06.41-.17l.76-.75c.25-.25.49-.44.72-.56.23-.14.46-.21.71-.21.19 0 .39.04.61.13.22.09.45.22.7.39l3.31 2.35c.26.18.44.39.55.64.1.25.16.5.16.78z"></path>
                        </svg>
                        +628XXXXXXXX
                     </p>
                  </div>
               </div>
            </div>
         @endforeach
      </div>
   </div>

<script>

document.getElementById("search").addEventListener("keyup", async (element)=>{
      const search = await fetch(`${window.location.pathname}/api/product?search=${element.target.value}`, {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-Token': document.head.querySelector("[name~=csrf-token][content]").content,
        },
      }).then(response => response.json()).then(response =>{
         console.log(response)
         document.getElementById('listProduct').innerHTML = '';
         response.forEach((item)=>{
            document.getElementById('listProduct').innerHTML += `
               <li class="inline-flex border-solid border-2 border-gray-200 items-center gap-x-2 py-3 px-4 text-sm border text-blue-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg ">
                  <div class="flex items-center justify-between w-full">
                     <span class="font-semibold min-w-[8em] text-start ">${item.name}</span>
                     <span class="font-semibold min-w-[8em] text-start">Rp.${item.price}</span>
                     <span class="font-semibold min-w-[8em] text-start">${item.category.name}</span>
                     <form method="POST" action="${window.location.pathname}/addOrderCustomer" class="flex justify-center items-center  gap-4 ">
                     <input type="hidden" name="_token" value="${document.head.querySelector("[name~=csrf-token][content]").content}">
                     <input type="hidden" name="_method" value="POST">
                     <input id="note" name="note" type="text" class="peer h-10 border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Note" />
                     <input id="dicount" name="dicount" type="text" class="peer h-10 w-[5em] border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Dicount/ %" />
                     <div class="py-2 px-3 inline-block border border-gray-200 rounded-lg " >
                     <div class="flex items-center gap-x-1.5">
                        <button type="button" decrement class="w-6 h-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none " >
                           <svg class="flex-shrink-0 w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/></svg>
                        </button>
                        <input id="amount" name="amount" class="p-0 w-6 bg-transparent border-0 text-gray-800 text-center focus:ring-0 " type="text" value="0">
                        <button  increment type="button" class="w-6 h-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none " >
                           <svg class="flex-shrink-0 w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                        </button>
                     </div>
                     </div>

                     <input type="hidden" name="product_id" value="${item.uuid}">
                     <input type="hidden" name="user_id" value="${document.querySelector('[current-user]').getAttribute('current-user')}">
                        <button class="rounded-full bg-blue-700 w-[2em] h-[2em] text-white flex items-center">
                           <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path class="stroke-gray-200" d="M6 12H18M12 6V18" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                           </svg>
                        </button>
                     </form>
                  </div>
               </li>
            `;
         })
         document.querySelectorAll('[decrement]').forEach((element) => {
            element.addEventListener('click', () => {
               const inputElement = element.nextElementSibling;
               inputElement.value = Math.max(0, parseInt(inputElement.value) - 1);
            });
         });

         document.querySelectorAll('[increment]').forEach((element) => {
            element.addEventListener('click', () => {
               const inputElement = element.previousElementSibling;
               inputElement.value = parseInt(inputElement.value) + 1;
            });
         });
      })
})

document.querySelectorAll('[decrement]').forEach((element) => {
    element.addEventListener('click', () => {
        const inputElement = element.nextElementSibling;
        inputElement.value = Math.max(0, parseInt(inputElement.value) - 1);
    });
});

document.querySelectorAll('[increment]').forEach((element) => {
    element.addEventListener('click', () => {
        const inputElement = element.previousElementSibling;
        inputElement.value = parseInt(inputElement.value) + 1;
    });
});



function toggleModal(modalId){
   document.getElementById(modalId).classList.toggle('hidden')
};
document.querySelectorAll('.close-modal').forEach(element => {
   element.addEventListener('click',()=>element.parentNode.classList.toggle('hidden'));
});

document.getElementById('submit').addEventListener('click', async () => {
  try {
    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
    
    const response = await fetch(`${window.location.pathname}/submitCustomer`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-Token': csrfToken,
      },
      body: JSON.stringify({
        name: document.getElementById('name').value,
        address: document.getElementById('address').value,
        phone: document.getElementById('phone').value,
      }),
    });

    const responseData = await response.json();

    if (response.ok) {
      document.getElementById('alert').innerHTML=`
         <div id="alert-message" class="max-w-xs bg-white border border-gray-200 rounded-xl shadow-lg dark:bg-gray-800  absolute z-[100] right-4 top-4 p-4 {{ session('error') ? 'bg-red-400' : 'bg-green-400' }}">
            <div class="flex p-4">
            <div class="flex-shrink-0">
               <svg class="flex-shrink-0 h-4 w-4 text-teal-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
               <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
               </svg>
            </div>
            <div class="ms-3">
               <p class="text-sm text-gray-700 dark:text-gray-400">
                  ${responseData.message}
               </p>
            </div>
            </div>
         </div>
      `
      setTimeout(function () {
            document.getElementById('alert').innerHTML=''
      }, 2000);

      const resCustomer = await fetch(`${window.location.pathname}/listCustomer`, {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-Token': csrfToken,
        },
      });

      const resCustomerData = await resCustomer.json();
     if (resCustomer.ok) {
        document.getElementById('listCustomer').innerHTML = '';
         resCustomerData.forEach((data) => {
            document.getElementById('listCustomer').innerHTML += `
               <li class="inline-flex border-solid border-2 border-gray-200 items-center gap-x-2 py-3 px-4 text-sm border text-blue-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg ">
                  <div class="flex items-center justify-between w-full">
                     <span class="font-semibold ">${data.name}</span>
                     <a href="${window.location.pathname}?user=${data.uuid}" class="rounded-full bg-blue-700 w-[2em] h-[2em] text-white">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path class="stroke-gray-200" d="M6 12H18M12 6V18" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                     </a>
                  </div>
               </li>
            `;
         });
         
      }else{

      }
    } else {
      console.error(responseData, 'ee');
    }
  } catch (error) {
    console.error('An error occurred:', error);
  }
});

</script>
@endsection