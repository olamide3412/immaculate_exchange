<script setup>
import { reactive, ref, watch } from 'vue';
import LogListing from '@/Components/Auth/Logs/Listing.vue';
import Pagination from '@/Components/Pagination.vue';
import { debounce } from 'lodash';
import { router } from '@inertiajs/vue3';
import SelectInput from '@/Components/Forms/SelectInput.vue';
import TextInput from '@/Components/Forms/TextInput.vue';

const props = defineProps({
    logs: {
        type: Object,
        required: true
    },
    searchTerm: String,
    orderBy: {
        type: String,
        default: 'id'
    },
    orderDir: {
        type: String,
        default: 'desc'
    }
})


const params = reactive({
    search : props.searchTerm,
    orderBy : props.orderBy,
    orderDir : props.orderDir
})
watch(params,
    debounce((params) =>
        router.get( route('exchangeRates.index'),
            { search: params.search, orderBy: params.orderBy, orderDir: params.orderDir},
            { preserveState: true}),
            1000
    )
);

</script>
<template>
    <div class="">

        <div class="md:flex md:justify-end md:items-center md:space-x-2 mb-4 p-4">
            <div class=" w-full md:w-1/4  ">
                <TextInput type="search" name="Search" v-model="params.search" :required="false" label="Search"  />
            </div>
            <div class="w-full md:w-1/4 ">
                <SelectInput name="order by" v-model="params.orderBy"
                    :options="[
                            {value:'id', label:'Id'},{value:'log', label:'Log'}, {value:'user_id', label:'UserId'}
                        ]"
                />
            </div>
            <div class=" w-full md:w-1/4 ">
                <SelectInput name="Order Dir" v-model="params.orderDir"
                    :options="[{value:'asc', label:'ASC'},{value:'desc', label:'DESC'}]"
                />
            </div>

        </div>
        <LogListing v-for="(log, index) in logs.data" :key="log.id"
            :log="log" :index="index" :currentPage="logs.current_page"
            :perPage="logs.per_page" />
        <div>
            <Pagination :paginator="logs"/>
        </div>
    </div>

</template>
