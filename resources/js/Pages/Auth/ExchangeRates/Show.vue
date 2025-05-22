<script setup>
import SelectInput from '@/Components/Forms/SelectInput.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import TagInput from '@/Components/Forms/TagInput.vue'
import TriggerTags from '@/Components/Auth/WhatsAppResponses/TriggerTags.vue'
import { useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { ref } from 'vue';
import { useToast } from 'vue-toastification';

const isEditing = ref(false);
const matchTypes = usePage().props.enums.matchTypes;
const toast = useToast();

const props = defineProps({
  exchangeRate: {
    type: Object,
    required: true
  }
})



const form = useForm({
    name: props.exchangeRate.name,
    amount: props.exchangeRate.amount,
    rate: props.exchangeRate.rate,
    sort_order: props.exchangeRate.sort_order,
    is_visible: !!props.exchangeRate.is_visible, // the !! Convert 1/0 to true/false
})


const submit = () => {
    //router.post('register',form)
    form.put(route('exchangeRate.update', props.exchangeRate.id),{
        onError: () => {
            toast.error('Validation error');
        },
        onSuccess: () => {
            toast.success('Exchange rate modify succesfully');
            isEditing.value = false;
        }
    });
}

const deleteExchangeRate = () => {
    if (confirm('Are you sure you want to delete this exchange rate response?')) {
        form.delete(route('exchangeRate.destroy', props.exchangeRate.id), {
            onError: () => {
                toast.error('Error deleting');
            },
            onSuccess: () => {
                toast.success('Exchange rate deleted successfully!!!');
            }
        });
    }
}


</script>
<template>
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12 p-4">
    <!-- Show admin Details -->
    <div v-show="!isEditing">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg p-6">
        <div class="flex items-center">

          <div class="ml-4">
            <div class="flex flex-col sm:flex-row sm:items-start md:items-center space-y-2 sm:space-y-0 sm:space-x-1">
              <h1 class="text-2xl font-semibold">
                {{ exchangeRate.name }}
              </h1>
            </div>

            <p class="text-gray-600 dark:text-gray-100">Amount: {{ exchangeRate.amount }}</p>
            <p class="text-gray-600 dark:text-gray-100">Rate: {{ exchangeRate.rate }}</p>

          </div>
        </div>
      </div>

      <div class="py-3">
        <h3 class="text-2xl font-bold mb-3">Other Details</h3>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
          <p><strong>Visibility:</strong> {{ exchangeRate.is_visible ? 'Visibile' : 'Invisible' }}</p>
          <p><strong>Sort Order:</strong> {{ exchangeRate.sort_order }}</p>

          <p><strong>Created On:</strong> {{ $formatDate(exchangeRate.created_at) }}</p>
          <p><strong>Last Updated On:</strong> {{ $formatDate(exchangeRate.updated_at)  }}</p>

          <div class="mt-3  p-1 space-x-2 space-y-2 overflow-x-auto max-w-full">

            <button @click="isEditing = true" class="rounded-element px-5 py-2">
              Edit
            </button>

            <button @click="deleteExchangeRate" class="rounded-element bg-red-500 hover:bg-red-700 px-5 py-2">
              Delete
            </button>

          </div>
        </div>
      </div>
    </div>
    <!-- Edit View -->
    <div v-show="isEditing">
      <div class="shadow p-4 rounded-md">
        <!-- Add your edit form here -->
        <h1 class="title dark:text-white">Modify exchange rate</h1>
        <form @submit.prevent="submit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <TextInput name="name" v-model="form.name" :message="form.errors.name" :required="true"
                    placeholder="Bitcoin exchange rate" label="Name" />

                <TextInput name="amount" v-model="form.amount" :message="form.errors.amount" :required="true"
                    placeholder="Above $1000" label="Amount" />

                <TextInput name="rate" v-model="form.rate" :message="form.errors.rate" :required="true"
                    placeholder="NGN 1713/$" label="Rate" />

                <TextInput type="number" name="sort_order" v-model="form.sort_order" :message="form.errors.sort_order" :required="true"
                    placeholder="Sort order eg 1, 2, 3 ....." label="Sort Order" />

                <div class="rounded-md border border-gray-300 px-4 py-1  shadow-sm ring-1 ring-inset ring-slate-300 md:col-span-2">
                    <label> Visibility Status <span class=" text-red-500">*</span> </label>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" v-model="form.is_visible" name="is_visible"
                           class="border rounded py-2 px-3"/>
                        <span>{{ form.is_visible ? 'Visible' : 'Invisible' }} {{ form.is_visible}}</span>
                    </div>

                    <div v-if="form.errors.is_visible" class="text-red-500 text-xs mt-1">{{ form.errors.is_visible }}</div>
                </div>


            </div>
            <div class=" flex justify-center py-4 space-x-5">
                <button class="btn-primary" :disabled="form.processing">Update</button>
                <button class="btn-primary-red" type="button" @click="isEditing = false">Cancel</button>
            </div>

        </form>

      </div>
    </div>

  </div>
</template>

