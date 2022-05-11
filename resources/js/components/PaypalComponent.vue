<template>
    <div>
        <div ref="paypal"></div>
    </div>
</template>

<script>
// import image from "../assets/lamp.png"
import Toast from "../utils/toast";
export default {
    name: "Paypal",

    props: {
        plan: {
            type: Object,
            required: true,
        },
    },

    data: function () {
        return {
            loaded: false,
            paidFor: false,
            product: {
                price: 0,
                description: "",
                name: "",
            },
        };
    },
    mounted: function () {
        this.product.price = this.plan.cost;
        this.product.description = this.plan.description;
        this.product.name = this.plan.name;
        const script = document.createElement("script");
        script.src =
            "https://www.paypal.com/sdk/js?client-id=AYn-c3yy63pYMKIQScM4wQs9Rhb1xX6xlabGCrorVRrgF1hIjDBXjs1BsPI2PFOVVl26_k2Xu37zqBPa";
        script.addEventListener("load", this.setLoaded);
        document.body.appendChild(script);
    },
    methods: {
        setLoaded: function () {
            this.loaded = true;
            window.paypal
                .Buttons({
                    createOrder: (data, actions) => {
                        return actions.order.create({
                            purchase_units: [
                                {
                                    description: this.product.description,
                                    amount: {
                                        currency_code: "USD",
                                        value: this.product.price,
                                    },
                                },
                            ],

                            application_context: {
                                shipping_preference: "NO_SHIPPING",
                            },
                        });
                    },
                    onApprove: async (data, actions) => {
                        const order = await actions.order.capture();
                        this.paidFor = true;
                        console.log(order, data);
                        await this.addSubscription(order.id, order.status);
                    },
                    onError: (err) => {
                        console.log(err);
                    },
                })
                .render(this.$refs.paypal);
        },

        async addSubscription(orderId, status) {
            try {
                const data = {
                    order_id: orderId,
                    plan_id: this.plan.id,
                    status,
                };
                const response = await axios.post(
                    "/api/billing/add/subscription",
                    data
                );
                if (response.data.status) {
                    Toast.fire({
                        icon: "success",
                        text: "Subscription added successfully",
                    });
                    location.href = `/home`;
                } else {
                    Toast.fire({
                        icon: "error",
                        text: "Opps!, an error occurred please try again",
                    });
                }
            } catch (error) {
                console.log(error);
            }
        },
    },
};
</script>
