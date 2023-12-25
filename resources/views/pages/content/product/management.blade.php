@extends('pages.dashboard')

@section('content')
   <div class="m-6 ">
      <div class="relative flex flex-row justify-end rounded gap-6 bg-white p-3 shadow-sm  ring-1 ring-gray-900/5 ">
         <div class=" max-w-md">
            <form method="GET" action="{{url()->current()}}" class="relative mx-auto w-max">
            <input type="search" name="search"
                  class="peer cursor-pointer relative z-10 h-12 w-12 rounded-full border bg-transparent pl-12 outline-none focus:w-full focus:cursor-text focus:border-sky-400 focus:pl-16 focus:pr-4" />
            <svg xmlns="http://www.w3.org/2000/svg" class="absolute inset-y-0 my-auto h-8 w-12 border-r border-transparent stroke-gray-500 px-3.5 peer-focus:border-sky-400 peer-focus:stroke-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
               <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            </form>
         </div>
         <a href="{{route('showManagementProduct')}}" class="flex justify-end my-auto ">
            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path class="fill-blue-600 " d="M4.39502 12.0014C4.39544 12.4156 4.73156 12.751 5.14577 12.7506C5.55998 12.7502 5.89544 12.4141 5.89502 11.9999L4.39502 12.0014ZM6.28902 8.1116L6.91916 8.51834L6.91952 8.51777L6.28902 8.1116ZM9.33502 5.5336L9.0396 4.84424L9.03866 4.84464L9.33502 5.5336ZM13.256 5.1336L13.4085 4.39927L13.4062 4.39878L13.256 5.1336ZM16.73 7.0506L16.1901 7.57114L16.1907 7.57175L16.73 7.0506ZM17.7142 10.2078C17.8286 10.6059 18.2441 10.8358 18.6422 10.7214C19.0403 10.607 19.2703 10.1915 19.1558 9.79342L17.7142 10.2078ZM17.7091 9.81196C17.6049 10.2129 17.8455 10.6223 18.2464 10.7265C18.6473 10.8307 19.0567 10.5901 19.1609 10.1892L17.7091 9.81196ZM19.8709 7.45725C19.9751 7.05635 19.7346 6.6469 19.3337 6.54272C18.9328 6.43853 18.5233 6.67906 18.4191 7.07996L19.8709 7.45725ZM18.2353 10.7235C18.6345 10.8338 19.0476 10.5996 19.1579 10.2004C19.2683 9.80111 19.034 9.38802 18.6348 9.2777L18.2353 10.7235ZM15.9858 8.5457C15.5865 8.43537 15.1734 8.66959 15.0631 9.06884C14.9528 9.46809 15.187 9.88119 15.5863 9.99151L15.9858 8.5457ZM19.895 11.9999C19.8946 11.5856 19.5585 11.2502 19.1443 11.2506C18.7301 11.251 18.3946 11.5871 18.395 12.0014L19.895 11.9999ZM18.001 15.8896L17.3709 15.4829L17.3705 15.4834L18.001 15.8896ZM14.955 18.4676L15.2505 19.157L15.2514 19.1566L14.955 18.4676ZM11.034 18.8676L10.8815 19.6019L10.8839 19.6024L11.034 18.8676ZM7.56002 16.9506L8.09997 16.4301L8.09938 16.4295L7.56002 16.9506ZM6.57584 13.7934C6.46141 13.3953 6.04593 13.1654 5.64784 13.2798C5.24974 13.3942 5.01978 13.8097 5.13421 14.2078L6.57584 13.7934ZM6.58091 14.1892C6.6851 13.7884 6.44457 13.3789 6.04367 13.2747C5.64277 13.1705 5.23332 13.4111 5.12914 13.812L6.58091 14.1892ZM4.41914 16.544C4.31495 16.9449 4.55548 17.3543 4.95638 17.4585C5.35727 17.5627 5.76672 17.3221 5.87091 16.9212L4.41914 16.544ZM6.05478 13.2777C5.65553 13.1674 5.24244 13.4016 5.13212 13.8008C5.02179 14.2001 5.25601 14.6132 5.65526 14.7235L6.05478 13.2777ZM8.30426 15.4555C8.70351 15.5658 9.11661 15.3316 9.22693 14.9324C9.33726 14.5331 9.10304 14.12 8.70378 14.0097L8.30426 15.4555ZM5.89502 11.9999C5.89379 10.7649 6.24943 9.55591 6.91916 8.51834L5.65889 7.70487C4.83239 8.98532 4.3935 10.4773 4.39502 12.0014L5.89502 11.9999ZM6.91952 8.51777C7.57513 7.50005 8.51931 6.70094 9.63139 6.22256L9.03866 4.84464C7.65253 5.4409 6.47568 6.43693 5.65852 7.70544L6.91952 8.51777ZM9.63045 6.22297C10.7258 5.75356 11.9383 5.62986 13.1059 5.86842L13.4062 4.39878C11.9392 4.09906 10.4158 4.25448 9.0396 4.84424L9.63045 6.22297ZM13.1035 5.86793C14.2803 6.11232 15.3559 6.7059 16.1901 7.57114L17.27 6.53006C16.2264 5.44761 14.8807 4.70502 13.4085 4.39927L13.1035 5.86793ZM16.1907 7.57175C16.9065 8.31258 17.4296 9.21772 17.7142 10.2078L19.1558 9.79342C18.8035 8.5675 18.1557 7.44675 17.2694 6.52945L16.1907 7.57175ZM19.1609 10.1892L19.8709 7.45725L18.4191 7.07996L17.7091 9.81196L19.1609 10.1892ZM18.6348 9.2777L15.9858 8.5457L15.5863 9.99151L18.2353 10.7235L18.6348 9.2777ZM18.395 12.0014C18.3963 13.2363 18.0406 14.4453 17.3709 15.4829L18.6312 16.2963C19.4577 15.0159 19.8965 13.5239 19.895 11.9999L18.395 12.0014ZM17.3705 15.4834C16.7149 16.5012 15.7707 17.3003 14.6587 17.7786L15.2514 19.1566C16.6375 18.5603 17.8144 17.5643 18.6315 16.2958L17.3705 15.4834ZM14.6596 17.7782C13.5643 18.2476 12.3517 18.3713 11.1842 18.1328L10.8839 19.6024C12.3508 19.9021 13.8743 19.7467 15.2505 19.157L14.6596 17.7782ZM11.1865 18.1333C10.0098 17.8889 8.93411 17.2953 8.09997 16.4301L7.02008 17.4711C8.06363 18.5536 9.40936 19.2962 10.8815 19.6019L11.1865 18.1333ZM8.09938 16.4295C7.38355 15.6886 6.86042 14.7835 6.57584 13.7934L5.13421 14.2078C5.48658 15.4337 6.13433 16.5545 7.02067 17.4718L8.09938 16.4295ZM5.12914 13.812L4.41914 16.544L5.87091 16.9212L6.58091 14.1892L5.12914 13.812ZM5.65526 14.7235L8.30426 15.4555L8.70378 14.0097L6.05478 13.2777L5.65526 14.7235Z" fill="#000000"/>
            </svg>
         </a>
         <div class="text-center">
            <button id="show-modal" class="rounded-full bg-blue-500 px-5 py-3 text-base  font-medium text-white transition duration-200 hover:bg-blue-600 active:bg-blue-700">
               Add Items
            </button>
         </div>
      </div>
   </div>

<div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
  <table class="w-full bg-white text-left text-sm text-gray-500">
    <thead class="bg-gray-50">
      <tr>
        <th scope="col" class="px-6 py-4 font-medium text-gray-900 min-w-[150px]">Product Name</th>
        <th scope="col" class="px-6 py-4 font-medium text-gray-900 min-w-[150px]">Prace (/psc)</th>
        <th scope="col" class="px-6 py-4 font-medium text-gray-900 min-w-[150px]">Description</th>
        <th scope="col" class="px-6 py-4 font-medium text-gray-900 min-w-[150px]">Category</th>
        <th scope="col" class="px-6 py-4 font-medium text-gray-900 min-w-[50px] ">

        </th>
      </tr>
    </thead>
    <tbody class=" divide-gray-100 border-t border-gray-100">
      @if (request()->routeIs('showManagementProduct'))
         @foreach ($products as $product)
         <tr class="hover:bg-gray-50">
         <td class="min-w-[150px] px-6 py-4 font-medium text-gray-700 ">{{$product->name}}</td>
         <td class="px-6 py-4 font-semibold ">Rp.{{number_format($product->price, 2, '.', ',') }} </td>
         <td class="px-6 py-4 ">{{$product->description}}</td>
         <td class="px-6 py-4 font-semibold">{{$product->category->name}}</td>

         <td class="px-6 py-4">
            <div class="flex justify-end gap-4">
               <form action="{{ route('deleteProduct', $product->uuid) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                     </svg>
                  </button>
               </form>
               <a  href="{{route('editProduct',$product->uuid)}}">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip" >
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
               </svg>
               </a>
            </div>
         </td>
         </tr>
         @endforeach
      @endif
    </tbody>
  </table>
</div>
<!-- component -->
<div id='modal-container' class="{{request()->routeIs('editProduct') ? '' : 'hidden' }} flex items-center justify-center max-w-screen max-h-screen ml-[-25%]">
   <div x-show="showModal" class="fixed inset-0 transition-opacity z-20">
      <div class="absolute inset-0 bg-gray-500 opacity-75 "></div>
   </div>
   <a id="close-modal" 
      @if(request()->routeIs('editProduct'))
      href="{{ route('showManagementProduct') }}"
      @endif
      class="fixed top-0 right-0 p-2 px-5 text-white z-20">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
      </svg>
   </a>
   <div class=" text-center top-8 fixed z-20 ">
      <div class="py-16 px-7 rounded-md bg-white">
         <form class="" method="POST" action="{{request()->routeIs('editProduct') ? route('updateProduct',$products->uuid) : route('createProduct')}}"> 
            @csrf
            @if (request()->routeIs('editProduct'))
               @method('PUT')
            @endif
            <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
               <input type="text" id="product_name" name="product_name"
               placeholder=" {{request()->routeIs('editProduct') ? $products->name:'Product Name'}} "
               value="{{request()->routeIs('editProduct') ? $products->name: ''}}"
               class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-700 ">
                  @error('product_name')
                     <div class="text-red-500">{{ $message }}</div>
                  @enderror
               <input type="text" name="product_price" id="currency_field" pattern="^\Rp\d{1,3}(,\d{3})*(\.\d+)?Rp"
               placeholder=" {{request()->routeIs('editProduct') ?'Rp'.number_format($products->price, 2, '.', ','):'Product Price'}}" 
               value="{{request()->routeIs('editProduct') ? 'Rp'.number_format($products->price, 2, '.', ',') :''}}" data-type="currency" 
               class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-700" >
                  @error('product_price')
                     <div class="text-red-500">{{ $message }}</div>
                  @enderror
               <div class="md:col-span-2">
                  <label for="category" class="float-left block  font-normal text-gray-400 text-lg">Category</label>
                  <select id="category" name="category" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-700">
                     <option 
                     value="{{request()->routeIs('editProduct') ? $products->category->uuid:''}}" disabled selected >
                     {{request()->routeIs('editProduct') ? $products->category->name:'Select Category'}}
                  </option>
                      @foreach ($categories as $category)
                      <option value="{{$category->uuid}}">{{$category->name}}</option>
                      @endforeach
                  </select>
                  @error('category')
                     <div class="text-red-500">{{ $message }}</div>
                  @enderror
               </div>
               
               <div class="md:col-span-2">
                  <label for="file" class="float-left block  font-normal text-gray-400 text-lg">Make sure the photo size is 1:1</label>
                  <input type="file" id="file" name="file" placeholder="Select file" class="peer block w-full appearance-none border-none   bg-transparent py-2.5 px-0 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0">
                  @error('file')
                     <div class="text-red-500">{{ $message }}</div>
                  @enderror
               </div>
               <div class="md:col-span-2">
                  <textarea name="description" rows="5" cols="" 
                  placeholder="{{request()->routeIs('editProduct') ? $products->description:'Product Description'}} "
                  class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-700">{{request()->routeIs('editProduct') ?$products->description: ''}}</textarea>
                  @error('description')
                     <div class="text-red-500">{{ $message }}</div>
                  @enderror
               </div>
               <div class="md:col-span-2">
                  <button type="submit" class="py-3 text-base font-medium rounded text-white bg-blue-800 w-full hover:bg-blue-700 transition duration-300">Submit</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>





<script>

// document.querySelectorAll("input[data-type='currency']").forEach(function(input) {
//    input.addEventListener('keyup', function() {
//          formatCurrency(this);
//       });
//       input.addEventListener('blur', function() {
//          formatCurrency(this, "blur");
//       });
//    });

// function formatNumber(n) {
//     return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
// }

// function formatCurrency(input, blur) {
//     var input_val = input.value;
//     if (input_val === "") {
//         return;
//     }
//     var original_len = input_val.length;
//     var caret_pos = input.selectionStart;
//     if (input_val.indexOf(".") >= 0) {
//         var decimal_pos = input_val.indexOf(".");
//         var left_side = input_val.substring(0, decimal_pos);
//         var right_side = input_val.substring(decimal_pos);
//         left_side = formatNumber(left_side);
//         right_side = formatNumber(right_side);
//         if (blur === "blur") {
//             right_side += "00";
//         }
//         right_side = right_side.substring(0, 2);
//         input_val = "Rp" + left_side + "." + right_side;
//     } else {
//         input_val = formatNumber(input_val);
//         input_val = "Rp" + input_val;
//         if (blur === "blur") {
//             input_val += ".00";
//         }
//     }
//     input.value = input_val;
//     var updated_len = input_val.length;
//     caret_pos = updated_len - original_len + caret_pos;
//     input.setSelectionRange(caret_pos, caret_pos);
// }
!function() {
    document.querySelectorAll("input[data-type='currency']").forEach(function(e) {
        e.addEventListener('keyup', function() {
            n(this);
        });
        e.addEventListener('blur', function() {
            n(this, "blur");
        });
    });

    function n(e, t) {
        var r = e.value;
        if ("" === r) return;
        var u = r.length,
            c = e.selectionStart;
        if (r.indexOf(".") >= 0) {
            var i = r.indexOf("."),
                o = r.substring(0, i),
                a = r.substring(i);
            o = function(e) {
                return e.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }(o), a = function(e) {
                return e.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }(a);
            "blur" === t && (a += "00"), a = a.substring(0, 2), r = "Rp" + o + "." + a;
        } else r = function(e) {
            return e = e.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","), "Rp" + e;
        }(r), "blur" === t && (r += ".00");
        e.value = r;
        var l = r.length;
        c = l - u + c, e.setSelectionRange(c, c);
    }
}();

// !function(){document.querySelectorAll("input[data-type='currency']").forEach(function(n){n.addEventListener('keyup', function() { t(n) }), n.addEventListener('blur', function() { t(n, "blur") })});function t(n, r) { var i = n.value; if ("" === i) return; var u = i.length, o = n.selectionStart; if (i.indexOf(".") >= 0) { var e = i.indexOf("."), a = i.substring(0, e), c = i.substring(e); a = n(a), c = n(c); "blur" === r && (c += "00"), c = c.substring(0, 2), i = "Rp" + a + "." + c } else i = n(i), i = "Rp" + i, "blur" === r && (i += ".00"); n.value = i; var s = i.length; o = s - u + o, n.setSelectionRange(o, o)}function n(t) { return t.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}();
document.getElementById('close-modal').addEventListener('click', function() { 
   document.getElementById('modal-container').classList.add('hidden');
})
document.getElementById('show-modal').addEventListener('click', function() { 
   document.getElementById('modal-container').classList.remove('hidden');
})

</script>
@endsection