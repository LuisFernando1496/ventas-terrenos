<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Terminal de Ventas
        </h2>
    </x-slot>
    <div class="row my-4 " style="padding-left: 20px;">
        <div class="col-md-4">
            <div class="input-group">
                <input type="text" id="bar_code" onkeydown="searchByBarcode()" class="form-control"
                    placeholder="Código de barra" />
                <div class="input-group-append">
                    <button id="addProductByBarcodeButton" onclick="searchByBarcode()" class="btn btn-outline-secondary">
                        <svg width="1em" height="2em" viewBox="0 0 16 16" class="bi bi-upc-scan" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z" />
                            <path
                                d="M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" id="search" style="text-transform: uppercase" class="form-control" name="search"
                    autocomplate="search" placeholder="Buscar producto" />
                <div class="input-group-append">
                    <button id="searchButton" class="btn btn-outline-secondary">
                        <svg width="1em" height="2em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
                            <path fill-rule="evenodd"
                                d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-12" style="padding-left: 10px;">
            <table id="resultTable" class="table table-sm table-hover table-responsive-lg overflow-auto my-2" hidden>
                <thead>
                    <tr>
                        <th>Resultado de búsqueda
                            <button id="cleanSearchButton"
                                class="ml-2 btn btn-outline-secondary btn-sm"><small>LIMPIAR</small></button>
                        </th>
                    </tr>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Colonia</th>
                        <th scope="col">No. Terreno</th>
                        <th scope="col">lote</th>
                        <th scope="col">manzana</th>
                        <th scope="col">dimenciones</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Proyecto</th>
                        <th scope="col">Unidad</th>
                    </tr>
                </thead>
                <tbody id="searchResult">
                </tbody>
            </table>
        </div>
    </div>
    <form id="shoppingListForm" class="needs-validation was-validated" novalidate>
        <div class="row" style="padding-left: 20px;">
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive-lg overflow-auto">
                            <table class="table">
                                <thead class="bg-secondary thead-light" style="color: white">
                                    <tr>
                                        <th colspan="13">Productos a comprar</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Código</th>
                                        <th scope="col">Colonia</th>
                                        <th scope="col">No. Terreno</th>
                                        <th scope="col">lote</th>
                                        <th scope="col">manzana</th>
                                        <th scope="col">dimenciones</th>
                                        <th scope="col">Proyecto</th>
                                        <th scope="col">Unidad</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Descuento</th>
                                        <th scope="col">Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="shoppingList">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card py-2">
                    <div class="row">
                        <div class="col-md-12 my-2">
                            <div class="row mx-2">
                                <div class="col-md-12">
                                    <div class="form-group" style="position: relative">
                                        <label for="additional_discount">Descuento adicional (%)</label>
                                        <input type="number" step="any" min="0" max="100" class="form-control"
                                            id="additional_discount" />
                                        <div class="invalid-tooltip">Descuento inválido</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-2">
                                <div class="col-md-6">
                                    <h6>Subtotal:</h6>
                                </div>
                                <div class="col-md-6">
                                    <h6>$ <span id="generalSubtotal">0.00</span></h6>
                                </div>
                            </div>
                            <div class="row mx-2">
                                <div class="col-md-6">
                                    <h6>Descuento:</h6>
                                </div>
                                <div class="col-md-6">
                                    <h6>$ <span id="totalDiscount">0.00</span></h6>
                                </div>
                            </div>
                            <div class="row mx-2">
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold">Total a pagar:</h6>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold">$ <span id="totalSale">0.00</span> MXN</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 my-2">
                            <div class="row mx-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="payment_type">Tipo de pago</label>
                                        <select class="form-control" id="payment_type">
                                            <option value="0">Efectivo</option>
                                            <option value="1">Tarjeta</option>
                                            <option value="2">Crédito</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="client">Cliente</label>
                                    <select class="form-control" name="client_id" id="client_id">
                                        <option value="">Cliente general</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->name }}
                                                {{ $client->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <div class="float-right pt-1">
                                        <input hidden type="radio" id="USD" name="USD">
                                    </div>
                                    <div class="float-left pt-1">
                                        <input hidden type="radio" id="MXN" name="MXN" checked>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="ingress">Pago con</label>
                                        <input type="number" step="any" min="0" class="form-control" id="ingress"
                                            required />
                                    </div>
                                </div>
                            </div>
                            <div class="pt-1">
                                <div class="row mx-2">
                                    <div class="col-md-6">
                                        <h6 class="font-weight-bold">Cambio:</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="turnedDiv">
                                            <h6 class="font-weight-bold">$ <span id="turned">0.00</span> MXN</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row my-4 mx-2">
                                <div class="col-md-12">
                                    <button type="button" id="paymentButton" class="btn btn-primary btn-block"
                                        disabled>PAGAR</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
    <script src="{{ asset('js/ventas.js') }}"></script>
</x-app-layout>
