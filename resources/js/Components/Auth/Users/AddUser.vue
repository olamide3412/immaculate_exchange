<script setup>
import TextInput from '@/Components/Forms/TextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import SelectInput from '../../Forms/SelectInput.vue';
import { useToast } from 'vue-toastification';

const roles = usePage().props.enums.roles;
const toast = useToast();
const emit = defineEmits(['change-active-tab']);


const form = useForm({
    name: null,
    user_name: null,
    phone_number: null,
    email: null,
    role: roles[1].value,
    password: null,
    password_confirmation: null,
})

const submit = () => {
    //router.post('register',form)
    form.post(route('users.store'),{
        onError: () => {
            form.reset("password","password_confirmation");
            toast.error('Validation error');
        },
        onSuccess: () => {
            toast.success('User account created succesfully');
            form.reset();
            emit('change-active-tab');
        }
    });
}

</script>
<template>
    <div class="container-xl lg:container m-auto p-5">
        <h1 class="title dark:text-white">Create a new user account</h1>
        <form @submit.prevent="submit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <TextInput name="name" label="Name" v-model="form.name" :message="form.errors.name" :required="true"/>
                <TextInput name="user_ame" label="User name"  v-model="form.user_name" :message="form.errors.user_name" :required="true"/>
                <TextInput name="phone" label="Phone Number"  type="tel" v-model="form.phone_number" :message="form.errors.phone_number"/>
                <TextInput name="Email" label="Email"  type="email" v-model="form.email" :message="form.errors.email" :required="true"/>
                <SelectInput
                    name="Role" v-model="form.role"
                    :message="form.errors.gender" :required="true"
                    :options="roles"
                    />
                <TextInput name="password"  label="Password"  type="password" v-model="form.password" :message="form.errors.password" :required="true"/>
                <TextInput name="password_confirmation"  label="Password Confirmation"  type="password" v-model="form.password_confirmation" :message="form.errors.password_confirmation" :required="true"/>
            </div>
            <div class=" flex justify-center py-4">
                <button class="btn-primary" :disabled="form.processing">Register</button>
            </div>

        </form>

    </div>
</template>

