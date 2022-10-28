<template>
    <div class="input-container">
        <input id="password" :type="type" class="form-control" name="password" required autocomplete="current-password" />
        <span v-if="type=='password'" class="fa fa-eye icon-input" @click="type='text'"></span>
        <span v-else class="fa fa-eye-slash icon-input" @click="type='password'"></span>
    </div>
</template>

<script>
export default {
    data() {
        return {
            type: "password"
        }
    },
}
</script>
<style scoped>
.input-container {
    position: relative;
}

.icon-input {
    position: absolute;
    right: 10px;
    top: 10px;
    cursor: pointer;
    font-size: 17px;
    color: #888;
}
</style>