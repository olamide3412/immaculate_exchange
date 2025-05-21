<script setup>
import SelectInput from '@/Components/Forms/SelectInput.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { ref } from 'vue';
import { useToast } from 'vue-toastification';

const activeTab = ref('show');

const roles = usePage().props.enums.roles;
const statuses = usePage().props.enums.statuses;
const toast = useToast();

const props = defineProps({
  user: {
    type: Object,
    required: true
  },
  isShowProfile: {
    type: Boolean,
    default: false
  }
})

const form = useForm({
    name: props.user.name,
    user_name: props.user.user_name,
    phone_number: props.user.phone_number,
    email: props.user.email,
    role: props.user.role,
    status: props.user.status,
});

const resetPasswordForm = useForm({
    password: null,
    password_confirmation: null,
    current_password: null
});


const isEnable = computed(() => props.user.status === 'enable')

const submit = () => {
    //router.post('register',form)
    form.patch(route('users.update', props.user),{
        onError: () => {
            toast.error('Validation error');
        },
        onSuccess: () => {
            toast.success('User account modify succesfully');
        }
    });
}

const deleteUser = () => {
    if (confirm('Are you sure you want to delete this user?')) {
        form.delete(route('user.destroy', props.user.id), {
            onError: () => {
                toast.error('Error deleting');
            },
            onSuccess: () => {
                toast.success('User deleting deleted successfully!!!');
            }
        });
    }
}

const resetPassword = (route_name) => {
    //router.post('register',form)
    resetPasswordForm.post(route(route_name, props.user),{
        onError: () => {
            toast.error('Validation error');
        },
        onSuccess: () => {
            toast.success('User password updated succesfully');
        }
    });
}


</script>
<template>
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
    <!-- Show User Details -->
    <div v-if="activeTab == 'show'">
      <div class="bg-white dark:bg-gray-800  overflow-hidden shadow-md sm:rounded-lg p-6">
        <div class="flex items-center">
          <div class="ml-4">
            <div class="flex flex-col sm:flex-row sm:items-start md:items-center space-y-2 sm:space-y-0 sm:space-x-1">
              <h1 class="text-2xl font-semibold">
                {{ user.name }}
              </h1>
              <span
                class="rounded-xl p-1 text-xs w-fit"
                :class="isEnable ? 'bg-green-200 dark:bg-green-500' : 'bg-red-200 dark:bg-red-500'"
              >
              <font-awesome-icon :icon="isEnable ? ['fas', 'certificate'] : ['fas', 'xmark'] "/>

                {{ isEnable ? 'Enabled' : 'Disabled' }}
              </span>
            </div>

            <p class="text-gray-600 dark:text-gray-100">Phone: {{ user.phone_number ?? 'Nill' }}</p>
            <p class="text-gray-600 dark:text-gray-100">User Nmae: {{ user.user_name ?? 'Nill' }}</p>
            <p class="text-gray-600 dark:text-gray-100">Role: {{ user.role }}</p>
          </div>
        </div>
      </div>

      <div class="py-3">
        <h3 class="text-2xl font-bold mb-3">Other Details</h3>
        <div class="bg-white dark:bg-gray-800  p-6 rounded-lg shadow-md">
          <p><strong>Status:</strong> {{ user.status  }}</p>

          <p><strong>Created On:</strong> {{ $formatDate(user.created_at) }}</p>
          <p><strong>Last Updated On:</strong> {{ $formatDate(user.updated_at)  }}</p>

          <div class="mt-3  p-1 space-x-2 space-y-2 overflow-x-auto max-w-full">

            <button @click="activeTab = 'edit'" class="rounded-element">
              Edit
            </button>
            <button v-show="!isShowProfile" @click="activeTab = 'reset_password'" class="rounded-element">
              Reset Password
            </button>
            <button v-show="isShowProfile" @click="activeTab = 'change_password'" class="rounded-element">
              Change Password
            </button>
            <button v-show="!isShowProfile" @click="deleteUser" class="rounded-element bg-red-500 hover:bg-red-700">
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- Edit View -->
    <div v-if="activeTab == 'edit'">
      <div class="bg-white dark:bg-gray-800 shadow p-4 rounded-md">
        <!-- Add your edit form here -->
        <h1 class="title dark:text-white">Modify user account</h1>
        <form @submit.prevent="submit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <TextInput name="name" label="Name" v-model="form.name" :message="form.errors.name" :required="true"/>
                <TextInput name="user_ame" label="User name"  v-model="form.user_name" :message="form.errors.user_name" :required="true"/>
                <TextInput name="phone" label="Phone Number"  type="tel" v-model="form.phone_number" :message="form.errors.phone_number"/>
                <TextInput name="Email" label="Email"  type="email" v-model="form.email" :message="form.errors.email" :required="true"/>
                <SelectInput
                    name="Role" v-model="form.role"
                    :message="form.errors.role" :required="true"
                    :options="roles"
                    :disabled="isShowProfile"
                    />
                <SelectInput
                    name="Status" v-model="form.status"
                    :message="form.errors.status" :required="true"
                    :options="statuses"
                    :disabled="isShowProfile"
                    />
            </div>
            <div class=" flex justify-center py-4 space-x-5">
                <button class="btn-primary" :disabled="form.processing">Update</button>
                <button class="btn-primary-red" type="button" @click="activeTab = 'show'">Cancel</button>
            </div>

        </form>

      </div>
    </div>


    <!--Reset Password View-->
     <div v-if="activeTab == 'reset_password'">
      <div class="bg-white dark:bg-gray-800 shadow p-4 rounded-md">
        <!-- Add your edit form here -->
        <h1 class="title dark:text-white">Reset Password</h1>
        <form @submit.prevent="resetPassword('users.resetPassword')">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <TextInput name="password" label="Password"  type="password" v-model="resetPasswordForm.password"
                            :message="resetPasswordForm.errors.password"  :required="true"/>
                <TextInput name="password" label="Password Confirmation"  type="password" v-model="resetPasswordForm.password_confirmation"
                            :message="resetPasswordForm.errors.password_confirmation" :required="true"/>
            </div>
            <div class=" flex justify-center py-4 space-x-5">
                <button class="btn-primary" :disabled="form.processing">Reset</button>
                <button class="btn-primary-red" type="button" @click="activeTab = 'show'">Cancel</button>
            </div>

        </form>
      </div>
    </div>

     <!--Change Password View-->
     <div v-if="activeTab == 'change_password'" >
      <div class=" container mx-auto bg-white dark:bg-gray-800 shadow p-4 rounded-md ">
        <!-- Add your edit form here -->
        <h1 class="title dark:text-white">Change Password</h1>
        <form @submit.prevent="resetPassword('users.updatePassword')">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 ">
                <TextInput name="current_password" label="Current Password"  type="password" v-model="resetPasswordForm.current_password"
                            :message="resetPasswordForm.errors.current_password" :required="true"/>
                <TextInput name="password" label="Password"  type="password" v-model="resetPasswordForm.password"
                            :message="resetPasswordForm.errors.password"  :required="true"/>
                <TextInput name="password_confirmation" label="Password Confirmation"  type="password" v-model="resetPasswordForm.password_confirmation"
                            :message="resetPasswordForm.errors.password_confirmation" :required="true"/>

            </div>
            <div class=" flex justify-center py-4 space-x-5">
                <button class="btn-primary" :disabled="form.processing">Update</button>
                <button class="btn-primary-red" type="button" @click="activeTab = 'show'">Cancel</button>
            </div>

        </form>
      </div>
    </div>

  </div>
</template>

