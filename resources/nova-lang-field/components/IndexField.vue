<template>
  <div>
    <span>{{ field.value }}</span>
  </div>
</template>

<script>
export default {
  props: ['resource', 'resourceName', 'resourceId', 'field'],
};
</script>
