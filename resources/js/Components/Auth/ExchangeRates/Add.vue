<script setup>
import TextInput from '@/Components/Forms/TextInput.vue';
import SelectInput from '@/Components/Forms/SelectInput.vue';
import TagInput from '@/Components/Forms/TagInput.vue'
import { useForm } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';


const toast = useToast();
const emit = defineEmits(['change-active-tab']);

const form = useForm({
    name: null,
    amount: null,
    rate: null,

})


const submit = () => {
    //router.post('register',form)
    form.post(route('exchangeRate.store'),{
        onError: () => {
            toast.error('Validation error');
        },
        onSuccess: () => {
            toast.success('Exchange rate created succesfully');
            form.reset();
            emit('change-active-tab');
        }
    });
}

</script>
<template>
    <div class="container-xl lg:container m-auto p-5">
        <h1 class="title text-gray-900 dark:text-gray-200">Create a new exchange rate</h1>
        <form @submit.prevent="submit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <TextInput name="exchange_rate_name" v-model="form.name" :message="form.errors.name" :required="true"
                            placeholder="Bitcoin exchange rate" label="Exchange Rate Name" />
                 <TextInput name="amount" v-model="form.amount" :message="form.errors.amount" :required="true"
                            placeholder="Above $1000" label="Amount" />
                 <TextInput name="Name" v-model="form.rate" :message="form.errors.rate" :required="true"
                            placeholder="NGN 1713/$" label="Rate" />



            </div>
            <div class=" flex justify-center py-4">
                <button class="btn-primary" :disabled="form.processing">Create</button>
            </div>

        </form>

    </div>
</template>

