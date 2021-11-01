<div class="min-h-screen flex flex-row bg-gray-100">
  <div class="flex flex-col w-44 bg-white rounded-r-3xl overflow-hidden">
    <div class="flex items-center justify-center h-32 shadow-md">
      <div class="w-4xl  "><img src="{{asset('img/logo_inusual.png')}}" alt=""></div>
    </div>
      <ul class="flex flex-col py-4">
       {{--  <li>
          <a href="#" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
            <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-home"></i></span>
            <span class="text-sm font-medium">Dashboard</span>
          </a>
        </li>--}}
        @can('justFor', [['admin']])
      
        <li>
          <a href="{{ route('users') }}" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
            <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-user"></i></span>
            <span class="text-sm font-medium">Usuarios</span>
          </a>
        </li> 
       
        <li>
          <a href="{{ route('sucursales') }}" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
            <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-store"></i></span>
            <span class="text-sm font-medium">Sucursal</span>
          </a>
        </li>
        <li>
          <a href="{{ route('productos') }}" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
            <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-shopping-bag"></i></span>
            <span class="text-sm font-medium">Productos</span>
          </a>
        </li>
        @endcan
        <li>  
          <a href="#" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
            <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-chat"></i></span>
            <span class="text-sm font-medium">Ver Planos</span>
          </a>
        </li>
        <li>  
          <a href="#" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
            <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-chat"></i></span>
            <span class="text-sm font-medium">Vender</span>
          </a>
        </li>
        <li>  
          <a href="#" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
            <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-chat"></i></span>
            <span class="text-sm font-medium">Ventas</span>
          </a>
        </li>
        <li>  
          <a href="#" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
            <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-chat"></i></span>
            <span class="text-sm font-medium">Terrenos</span>
          </a>
        </li>
        <li>
          <a href="#" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
            <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-music"></i></span>
            <span class="text-sm font-medium">Compras</span>
          </a>
        </li>
        <li>
          <a href="#" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
            <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-music"></i></span>
            <span class="text-sm font-medium">Reportes</span>
          </a>
        </li>
        <li>
          <a href="#" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
            <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-bell"></i></span>
            <span class="text-sm font-medium">Devoluciones</span>
          </a>
        </li>
       
      </ul>
    </div>
  </div>