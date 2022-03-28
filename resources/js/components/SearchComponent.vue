<template>
    <div class="search mt-2">
        <Dropdown
            :options="[
                { id: 1, name: 'Option 1' },
                { id: 2, name: 'Option 2' },
            ]"
            v-on:selected="validateSelection"
            v-on:filter="getDropdownValues"
            :disabled="false"
            name="zipcode"
            :maxItem="10"
            placeholder="Please select an option"
            class=""
        >
        </Dropdown>
    </div>
</template>

<script>
import Dropdown from "vue-simple-search-dropdown";
export default {
    components: {
        Dropdown,
    },

    methods: {
        validateSelection(val) {
            console.log(val);
        },

        getDropdownValues(val) {
            console.log(val);
        },
    },

    mounted() {
        console.log("Component mounted.");
    },
};
</script>
