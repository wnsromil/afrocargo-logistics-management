<x-app-layout>
    <x-slot name="header">
        {{ __('Parcel Management') }}
    </x-slot>

    <x-slot name="cardTitle">
      <p class="head">Challan's Invoices Details</p>  

         <!-- <div class="d-flex align-items-center justify-content-end mb-1">
            <div class="usersearch d-flex">
                <div class="mt-2">
                  
                    <a href="#" class="btn btn-primary">
                    <img src="../assets/img/download.png" alt="img">
                      Download
                    </a>
                    </div>
                    <div class="mt-2">
                    <a href="{{route('admin.inventories.create')}}" class="btn btn-primary">
                       Print
                    </a>
                    </div>
            </div>
        </div>  -->

        <!-- <div class="col-md-6 text-end align-content-end">
                <button class="btn btn-primary me-2"><img src="../assets/img/download.png" alt="img">Download</button>
                <button class="btn btn-primary me-2"><img src="../assets/img/Print.png" alt="img">Print</button>
                
            </div> -->
            <div class="col-md-6 d-flex justify-content-end align-items-center">
    <button class="btn btn-primary me-2 d-flex align-items-center justify-content-center">
        <img src="{{asset('assets/img/download.png')}}" alt="img" class="me-2">Download
    </button>
    <button class="btn btn-primary d-flex align-items-center justify-content-center">
        <img src="{{asset('assets/img/Print.png')}}" alt="img" class="me-2">Print
    </button>
</div>
    </x-slot>

<div style="justify-items: center; ">
    <div style="border:solid 1px #737B8B; height:590px;width:650px;margin-top:87px;border-radius:6px;">
<div class="d-flex">
    <div style="margin-left:10px"><img src="{{asset('assets/img/logo_image.png')}}"></div>
    <div class="challanh"><p class="invoicei">Ivoirien Cargo NY 366 Concord </p>
<p class="invoicei">Ave NY, The Bronx10454</p>
    <p class="invoicei">Tel-646-468-4135</p>
<p class="invoicei">Tel 718-954-9093</p></div>


    <div class="challanh challan">
    <p class="invoicei">Ivoirien Cargo Abidjan Avenue </p>
    <p class="invoicei">21 Rue 15 Abidjan Autonomous,</p>
<p class="invoicei">Tel-07 09 04 1250</p>
<p class="invoicei">Tel-07 89 49 2486</p>
    </div>
</div>

<!-- head content done -->

<div>
    <div class="statusposition"><span class="inoice">Invoice No:</span>  <span class="invoic">INV 00001</span> </div>
    <div class="delta"><div><span>Date:  </span><span style="font-weight:600">02-25-2023</span></div> <span style="font-weight:600">Ivoirien Cargo</span></div>
    <div class="shift">
        <div>
       <span class=" invoicem">Ship To:</span>
       <span><p class="invoiceaa">Walter Roberson</p>
<p class="invoicec">299 Star Trek Drive, Panama City,</p>
<p class="invoicec">Florida, 32405, USA</p></span>
</div>

<div>
<p class="invoicem">Tracking Items: 3</p>
</div>
</div>


<div class="shift">
    <p class="invoicec">Plastic Wrapped Black</p>
</div>

<div class="statusposition  bar">
    <span><img src="{{asset('assets/img/Bar.png')}}"></span>
</div>

<div class="statusposition challanh">
    <p class="invoicec">Panama City,</p>
   <p class="invoicec"> Florida, 32405, USA</p>
</div>





    </div>















</div>










   















</div>
</div>




    <div>

       
                    <div class="bottom-user-page mt-3">
                        {!! $ParcelHistories->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
