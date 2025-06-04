<template>
  <header class="bg-(--light-green) shadow-sm p-4">
    <div class="flex justify-between items-center">
      <div class="flex items-center gap-4 text-(--dark-green)">
        <div>
          <button class="px-4 py-2 bg-(--button-green) text-white rounded-lg hover:bg-[#7ca460] cursor-pointer">
            Add Customer Information
          </button>
        </div>
      </div>

      <div class="flex items-center gap-4 text-[var(--dark-green)]">        
        <div class="p-2 rounded-lg transition hover:bg-white cursor-pointer relative group" title="Calculator">
          <i class="fas fa-calculator text-2xl"></i>
          <!-- Tooltip below -->
          <div class="absolute top-full left-1/2 -translate-x-1/2 mt-2 px-2 py-1 
           bg-white text-(--dark-green) text-xs rounded whitespace-nowrap
           opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity">
            Calculator
          </div>
        </div>

        <div class="p-2 rounded-lg transition hover:bg-white cursor-pointer relative group" title="Calculator">
          <i class="fas fa-sack-dollar text-2xl"></i>
          <!-- Tooltip below -->
          <div class="absolute top-full left-1/2 -translate-x-1/2 mt-2 px-2 py-1 
           bg-white text-(--dark-green) text-xs rounded whitespace-nowrap
           opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity">
            Other Charges
          </div>
        </div>

        <div class="p-2 rounded-lg transition hover:bg-white cursor-pointer relative group" title="Calculator">
          <i class="fas fa-arrow-right-from-bracket text-2xl"></i>
          <!-- Tooltip below -->
          <div class="absolute top-full left-1/2 -translate-x-1/2 mt-2 px-2 py-1 
           bg-white text-(--dark-green) text-xs rounded whitespace-nowrap
           opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity">
            Leave
          </div>
        </div>
      </div>

    </div>
  </header>
</template>

<script setup> 

</script>