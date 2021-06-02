<template>
    <span>
        <span></span>
        <span></span>
        <span></span>
    </span>
</template>

<script>
export default {};
</script>

<style scoped>
  span {
    height: 2rem;
    width: 1.75rem;
    display: flex;
    flex-direction: column;
    justify-content: space-evenly;
    align-items: center;
    margin-right: 1rem;
  }

  span > span {
    height: .25rem;
    width: 100%;
    background-color: rgb(45, 145, 118);
    border-radius: 2px;
  }
</style>
