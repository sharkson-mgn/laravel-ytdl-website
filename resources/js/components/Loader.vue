<template>
  <div class="w-100 justify-content-center align-items-center position-relative"
    style="
      top: 0;
    ">
      <div style="
          width: 100%;
          height: 100%;
          display: flex;
          position: relative;
          background-color: white;
        ">
          Czekaj...
      </div>
  </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component (Loader) mounted.')
        }
    }
</script>
