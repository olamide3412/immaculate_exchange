<script setup>
import TextInput from '@/Components/Forms/TextInput.vue';
import SelectInput from '@/Components/Forms/SelectInput.vue';
import TagInput from '@/Components/Forms/TagInput.vue'
import { useForm, usePage } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';

const matchTypes = usePage().props.enums.matchTypes;
const toast = useToast();
const emit = defineEmits(['change-active-tab']);

const form = useForm({
    name: null,
    response: null,
    triggers: [],
    match_type: 'exact',

})


const submit = () => {
    //router.post('register',form)
    form.post(route('whatsappResponse.store'),{
        onError: () => {
            toast.error('Validation error');
        },
        onSuccess: () => {
            toast.success('Whatsapp response created succesfully');
            form.reset();
            emit('change-active-tab');
        }
    });
}

</script>
<template>
    <div class="container-xl lg:container m-auto p-5">
        <h1 class="title text-gray-900 dark:text-gray-200">Create a new whatsapp response</h1>
        <form @submit.prevent="submit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <TextInput name="Name" v-model="form.name" :message="form.errors.name" :required="true"
                    placeholder="Enter response name" label="Response Name" />
                <SelectInput
                    name="Match Type" v-model="form.match_type"
                    :message="form.errors.match_type" :required="true"
                    :options="matchTypes"
                />

                 <!-- Triggers -->
                <div class="md:col-span-2" role="none" @keydown.enter.prevent>
                    <label>Triggers <span class=" text-red-500">*</span></label>
                    <TagInput v-model="form.triggers" placeholder="Type and press Enter" :message="form.errors.triggers"/>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-200">Press Enter after each trigger to add it.</p>
                    <div v-if="form.errors.triggers" class="text-red-500 text-xs mt-1">{{ form.errors.triggers }}</div>
                </div>

                <div class="md:col-span-2">
                    <label> Response <span class=" text-red-500">*</span> </label>
                    <textarea
                        v-model="form.response"  name="response" class="border rounded w-full py-2 px-3"
                        rows="4" placeholder="What response would like to send if trigger is recieved?" required>
                    </textarea>
                    <div v-if="form.errors.response" class="text-red-500 text-xs mt-1">{{ form.errors.response }}</div>
                </div>

            </div>
            <div class=" flex justify-center py-4">
                <button class="btn-primary" :disabled="form.processing">Create</button>
            </div>

        </form>

    </div>
</template>

