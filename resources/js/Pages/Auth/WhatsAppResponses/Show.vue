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
  whatsAppResponse: {
    type: Object,
    required: true
  }
})



const form = useForm({
    name: props.whatsAppResponse.name,
    response: props.whatsAppResponse.response,
    triggers: JSON.parse(props.whatsAppResponse.triggers),
    match_type: props.whatsAppResponse.match_type,
    is_active: !!props.whatsAppResponse.is_active
})


const submit = () => {
    //router.post('register',form)
    form.put(route('whatsAppResponse.update', props.whatsAppResponse),{
        onError: () => {
            toast.error('Validation error');
        },
        onSuccess: () => {
            toast.success('Whatsapp response modify succesfully');
            isEditing.value = false;
        }
    });
}

const deleteWhatsAppResponse = () => {
    if (confirm('Are you sure you want to delete this WhatsApp response?')) {
        form.delete(route('whatsAppResponse.destroy', props.whatsAppResponse), {
            onError: () => {
                toast.error('Error deleting');
            },
            onSuccess: () => {
                toast.success('Whatsapp response deleted successfully!!!');
            }
        });
    }
}


</script>
<template>
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
    <!-- Show admin Details -->
    <div v-show="!isEditing">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-6">
        <div class="flex items-center">

          <div class="ml-4">
            <div class="flex flex-col sm:flex-row sm:items-start md:items-center space-y-2 sm:space-y-0 sm:space-x-1">
              <h1 class="text-2xl font-semibold">
                {{ whatsAppResponse.name }}
              </h1>
            </div>

            <p class="text-gray-600 dark:text-gray-100">Triggers:</p>
            <TriggerTags :triggers="whatsAppResponse.triggers"/>
            <p class="text-gray-600 dark:text-gray-100">Response: {{ whatsAppResponse.response }}</p>

          </div>
        </div>
      </div>

      <div class="py-3">
        <h3 class="text-2xl font-bold mb-3">Other Details</h3>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
          <p><strong>Status:</strong> {{ whatsAppResponse.is_active ? 'Active' : 'Inactive' }}</p>
          <p><strong>Match Type:</strong> {{ whatsAppResponse.match_type }}</p>

          <p><strong>Created On:</strong> {{ $formatDate(whatsAppResponse.created_at) }}</p>
          <p><strong>Last Updated On:</strong> {{ $formatDate(whatsAppResponse.updated_at)  }}</p>

          <div class="mt-3  p-1 space-x-2 space-y-2 overflow-x-auto max-w-full">

            <button @click="isEditing = true" class="rounded-element px-5 py-2">
              Edit
            </button>

            <button @click="deleteWhatsAppResponse" class="rounded-element bg-red-500 hover:bg-red-700 px-5 py-2">
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
        <h1 class="title dark:text-white">Modify whatsapp response</h1>
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

                <div class="rounded-md border border-gray-300 px-4 py-3 shadow-sm ring-1 ring-inset ring-slate-300 md:col-span-2">
                    <label> Response Status <span class=" text-red-500">*</span> </label>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" v-model="form.is_active"  name="response"
                           class="border rounded py-2 px-3"/>
                        <span>{{ form.is_active ? 'Active' : 'Inactive' }}</span>
                    </div>

                    <div v-if="form.errors.is_active" class="text-red-500 text-xs mt-1">{{ form.errors.is_active }}</div>
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

