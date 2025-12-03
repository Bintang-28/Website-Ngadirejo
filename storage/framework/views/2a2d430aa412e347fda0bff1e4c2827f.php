<nav class="bg-white border-b border-gray-200 px-4 py-2.5 dark:bg-gray-800 dark:border-gray-700 fixed left-0 right-0 top-0 z-50">
  <div class="flex flex-wrap justify-between items-center">
    
    <div class="flex justify-start items-center">
      <button data-drawer-target="drawer-navigation" data-drawer-toggle="drawer-navigation" aria-controls="drawer-navigation" class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer md:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
        <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">Toggle sidebar</span>
      </button>

      <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center justify-between mr-4">
      <?php
          $siteLogo = App\Models\Setting::get('site_logo');
          $logoPath = $siteLogo 
              ? asset('storage/' . $siteLogo) 
              : asset('images/logokabmadiun.png');
      ?>
      <img src="<?php echo e($logoPath); ?>" alt="Logo Desa" class="block h-9 w-auto">
      <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white ml-3">Admin Desa</span>
      </a>
    </div>

    <div class="flex items-center lg:order-2">
      <button @click="toggle()" 
              class="relative inline-flex items-center h-8 w-14 rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
              :class="darkMode ? 'bg-blue-600' : 'bg-gray-300'">
          <span class="sr-only">Toggle Dark Mode</span>
          <span class="absolute left-1 top-1 flex h-6 w-6 transform items-center justify-center rounded-full bg-white shadow-lg transition-transform"
                :class="darkMode ? 'translate-x-6' : 'translate-x-0'">
              <svg x-show="!darkMode" class="h-4 w-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm0 13a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm6-7a1 1 0 011 1h1a1 1 0 110 2h-1a1 1 0 01-1-1zm-13-1a1 1 0 000 2h1a1 1 0 100-2H3zm12.122 9.879a1 1 0 01.002-1.414l.707-.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.416-.002zM4.04 4.04a1 1 0 01.002-1.414l.707-.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.416-.002zM15.96 4.04a1 1 0 011.414-1.414l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zM5.454 15.96a1 1 0 011.414-1.414l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zM10 7a3 3 0 100 6 3 3 0 000-6z"></path></svg>
              <svg x-show="darkMode" class="h-4 w-4 text-blue-700" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
          </span>
      </button>

      <div class="ms-3 relative">
          <?php if (isset($component)) { $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown','data' => ['align' => 'right','width' => '48']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'right','width' => '48']); ?>
               <?php $__env->slot('trigger', null, []); ?> 
                  <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                      <div><?php echo e(Auth::user()->name); ?></div>
                      <div class="ms-1"><svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg></div>
                  </button>
               <?php $__env->endSlot(); ?>
               <?php $__env->slot('content', null, []); ?> 
                  <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => route('profile.edit')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('profile.edit'))]); ?>
                      <?php echo e(__('Profile')); ?>

                   <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
                  <form method="POST" action="<?php echo e(route('logout')); ?>">
                      <?php echo csrf_field(); ?>
                      <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => route('logout'),'onclick' => 'event.preventDefault(); this.closest(\'form\').submit();']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('logout')),'onclick' => 'event.preventDefault(); this.closest(\'form\').submit();']); ?>
                          <?php echo e(__('Log Out')); ?>

                       <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
                  </form>
               <?php $__env->endSlot(); ?>
           <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $attributes = $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $component = $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
      </div>
    </div>
  </div>
</nav>

<aside class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidenav" id="drawer-navigation">
  <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">
    <ul class="space-y-2">
      <!-- Dashboard -->
      <li>
        <a href="<?php echo e(route('admin.dashboard')); ?>" 
           class="flex items-center p-2 text-base font-medium rounded-lg 
                  <?php echo e(request()->routeIs('admin.dashboard') 
                      ? 'bg-blue-100 dark:bg-gray-700 text-blue-600 dark:text-white' 
                      : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700'); ?> group">
          <svg class="w-6 h-6 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
          <span class="ml-3">Dashboard</span>
        </a>
      </li>

      <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
      <!-- Manajemen Akun -->
      <li>
        <a href="<?php echo e(route('admin.users.index')); ?>" 
           class="flex items-center p-2 text-base font-medium rounded-lg 
                  <?php echo e(request()->routeIs('admin.users.*') 
                      ? 'bg-blue-100 dark:bg-gray-700 text-blue-600 dark:text-white' 
                      : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700'); ?> group">
          <svg class="w-6 h-6 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
          <span class="ml-3">Manajemen Akun</span>
        </a>
      </li>
      <?php endif; ?>

      <?php if (\Illuminate\Support\Facades\Blade::check('hasanyrole', 'admin|penulis')): ?>
      <!-- Manajemen Berita -->
      <li>
        <a href="<?php echo e(route('admin.berita.index')); ?>" 
           class="flex items-center p-2 text-base font-medium rounded-lg 
                  <?php echo e(request()->routeIs('admin.berita.*') 
                      ? 'bg-blue-100 dark:bg-gray-700 text-blue-600 dark:text-white' 
                      : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700'); ?> group">
          <svg class="w-6 h-6 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2h1a2 2 0 100-4h-1V5a4 4 0 00-4-4H4a4 4 0 00-4 4v10a2 2 0 002 2h1a2 2 0 100-4h-1V5zm12 2H4v10h10V7z" clip-rule="evenodd"></path><path fill-rule="evenodd" d="M18 17a1 1 0 001-1v-4a1 1 0 00-2 0v4a1 1 0 001 1z" clip-rule="evenodd"></path></svg>
          <span class="ml-3">Manajemen Berita</span>
        </a>
      </li>
      <?php endif; ?>

      <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
      <!-- Divider -->
      <li class="pt-2 border-t border-gray-200 dark:border-gray-700">
        <span class="px-2 text-xs font-semibold text-gray-400 uppercase dark:text-gray-500">Pengaturan Website</span>
      </li>

      <!-- Statistik Desa - NEW! -->
      <li>
        <a href="<?php echo e(route('admin.statistik.index')); ?>" 
           class="flex items-center p-2 text-base font-medium rounded-lg 
                  <?php echo e(request()->routeIs('admin.statistik.*') 
                      ? 'bg-blue-100 dark:bg-gray-700 text-blue-600 dark:text-white' 
                      : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700'); ?> group relative">
          <svg class="w-6 h-6 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
          </svg>
          <span class="ml-3">Statistik Desa</span>
          <span class="ml-auto inline-flex items-center justify-center px-2 py-0.5 text-xs font-medium text-blue-800 bg-blue-100 rounded dark:bg-blue-900 dark:text-blue-300">
            Baru
          </span>
        </a>
      </li>

      <!-- Pengaturan Background Hero -->
      <li>
        <a href="<?php echo e(route('admin.settings.index')); ?>" 
           class="flex items-center p-2 text-base font-medium rounded-lg 
                  <?php echo e(request()->routeIs('admin.settings.*') 
                      ? 'bg-blue-100 dark:bg-gray-700 text-blue-600 dark:text-white' 
                      : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700'); ?> group">
          <svg class="w-6 h-6 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg>
          <span class="ml-3">Background Hero</span>
        </a>
      </li>
      <?php endif; ?>

      <!-- Divider untuk Aksi Lainnya -->
      <li class="pt-4 border-t border-gray-200 dark:border-gray-700 mt-4">
        <a href="<?php echo e(url('/')); ?>" target="_blank"
           class="flex items-center p-2 text-base font-medium text-gray-900 dark:text-white rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 group">
          <svg class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
          </svg>
          <span class="ml-3">Lihat Website</span>
          <svg class="w-4 h-4 ml-auto" fill="currentColor" viewBox="0 0 20 20">
            <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"/>
            <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"/>
          </svg>
        </a>
      </li>
    </ul>

    <!-- Footer Info -->
    <div class="absolute bottom-0 left-0 right-0 p-4 bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
      <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
        <span>© 2024 Desa Ngadirejo</span>
        <span class="font-semibold">v1.0.0</span>
      </div>
    </div>
  </div>
</aside><?php /**PATH X:\hasil coding\Web-Project-KKN-Ngadirejo\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>