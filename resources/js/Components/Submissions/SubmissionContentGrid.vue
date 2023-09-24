<template>
  <div class="grid grid-cols-5 gap-3">
    <div class="col-span-2">
      <p class="opacity-50 xl:w-5/6">
        <slot name="left" />
      </p>
    </div>

    <div class="col-span-3">
      <p>
        <slot name="right" />
      </p>
    </div>
  </div>
</template>
