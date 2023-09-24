<script setup>
import { ref } from "vue";
import { useGlobalLayout } from "@/stores/global";

const isOpen = ref(false);

const {toggleModal} = useGlobalLayout();

function closeModal() {
    isOpen.value = false;
    toggleModal(false);
    setTimeout(() => {
        openButtonRef.value.focus();
    }, 50);
}

async function openModal() {
    isOpen.value = true;
    toggleMobileMenu(false);
    await nextTick();
    await nextTick();
    toggleModal(true);
    setTimeout(() => {
        closeButtonRef.value.focus();
    }, 50);
}
</script>

<template>
  <div>
    <Teleport v-if="isOpen" to="body">
      <div class="slideover-wrapper" @keydown.esc="closeModal">
        <div class="slideover-content">
          <slot>
        </div>
      </div>
    </Teleport>
  </div>
</template>

