<template>
    <div class="container">
        Add book content
        <vue-editor v-model="content"></vue-editor>
    </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
export default {
    components: {
        VueEditor,
    },

    data: () => ({
      content: "<h1>Some initial content</h1>"
    })
};
</script>

<style></style>
