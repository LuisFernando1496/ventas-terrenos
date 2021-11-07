<div class="min-h-screen flex flex-row bg-gray-100">
    <div class="flex flex-col w-44 bg-white  overflow-hidden">
        <div class="flex items-center justify-center h-32 shadow-md" style="background-color: black">
            <div class="w-4xl  "><img src="{{ asset('img/roven-capital.jpeg') }}" style="height: 125px;width: 128px;" alt=""></div>
        </div>
        <ul class="flex flex-col py-4">
            {{-- <li>
          <a href="#" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
            <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-home"></i></span>
            <span class="text-sm font-medium">Dashboard</span>
          </a>
        </li> --}}
            @can('justFor', [['admin']])
                <li>
                    <a href="{{route('clients')}}"
                        class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                        <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400">
                          <span class="iconify" data-icon="fa-solid:users"></span></i></span>
                        <span class="text-sm font-medium">Clientes</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('projects')}}"
                        class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                        <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400">
                          <span class="iconify" data-icon="fa-solid:dolly-flatbed"></span></span>
                        <span class="text-sm font-medium">Proyectos</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                        <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400">
                          <span class="iconify" data-icon="icon-park-outline:figma-flatten-selection"></span></span>
                        <span class="text-sm font-medium">Inversiones</span>
                    </a>
                </li>
                </li>
                <a href="{{ route('productos') }}"
                    class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                    <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400">
                      <span class="iconify" data-icon="gridicons:product"></span></span>
                    <span class="text-sm font-medium">Productos</span>
                </a>
                </li>
                <li>
                    <a href="{{route('bussinesUnit')}}"
                        class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                        <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400">
                          <span class="iconify" data-icon="dashicons:businessman"></span></span>
                        <span class="text-sm font-medium">Unidades de negocio</span>
                    </a>
                </li>
                <li>
                    
                    <a href="#"
                        class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                        <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400">
                          <span class="iconify" data-icon="whh:salealt"></span></span>
                        <span class="text-sm font-medium">Historial ventas</span>
                    </a>
                </li>
                <li>
                    
                    <a href="{{route('sales')}}"
                        class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                        <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400">
                            <span class="iconify" data-icon="fa-solid:cash-register"></span></span></span>
                        <span class="text-sm font-medium">Hacer venta</span>
                    </a>
                </li>
            @endcan
            <li>
                <a href="#"
                    class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                    <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400">
                      <span class="iconify" data-icon="ant-design:dollar-circle-outlined"></span></span>
                    <span class="text-sm font-medium">Cargos</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                    <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400">
                      <span class="iconify" data-icon="fluent:payment-20-regular"></span></i></span>
                    <span class="text-sm font-medium">Pagos</span>
                </a>
            </li>
            <li>
                <a {{ route('pagos') }}
                    class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                    <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400">
                      <span class="iconify" data-icon="whh:resellerhosting"></span></span>
                    <span class="text-sm font-medium">Gastos</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                    <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400">
                         <span class="iconify" data-icon="wpf:statistics"></span></span>
                    <span class="text-sm font-medium">Reportes</span>
                </a>
            </li>
            <li>
                <a href="{{route('purchase')}}"
                    class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                    <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400">
                      <span class="iconify" data-icon="bx:bxs-shopping-bag-alt"></span></span>
                    <span class="text-sm font-medium">Compras</span>
                </a>
            </li>
            {{-- <li>
                <a href="#"
                    class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                    <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i
                            class="bx bx-bell"></i></span>
                    <span class="text-sm font-medium">Devoluciones</span>
                </a>
            </li>
            <li>
              <a href="{{ route('sucursales') }}"
                  class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                  <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i
                          class="bx bx-store"></i></span>
                  <span class="text-sm font-medium">Sucursal</span>
              </a>
          </li> --}}
            <li>
                <a href="{{ route('users') }}"
                    class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                    <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400">
                      <span class="iconify" data-icon="bx:bxs-user"></span></span>
                    <span class="text-sm font-medium">Usuarios</span>
                </a>
            </li>

        </ul>
    </div>
</div>
