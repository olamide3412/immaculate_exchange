<script setup>
import { reactive, ref, watch } from 'vue';
import ExchangeRateListing from './Listing.vue';
import Pagination from '../../Pagination.vue';
import { debounce } from 'lodash';
import { router } from '@inertiajs/vue3';
import SelectInput from '../../Forms/SelectInput.vue';
import TextInput from '../../Forms/TextInput.vue';

const props = defineProps({
    exchangeRates: {
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
        default: 'asc'
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

        <div class="md:flex md:justify-end md:items-center md:space-x-2 mb-4">
            <div class=" w-full md:w-1/4  ">
                <TextInput type="search" name="Search" v-model="params.search" :required="false" label="Search"  />
            </div>
            <div class="w-full md:w-1/4 ">
                <SelectInput name="order by" v-model="params.orderBy"
                    :options="[
                            {value:'id', label:'Id'},{value:'name', label:'Name'}, {value:'amount', label:'Amount'}
                        ]"
                />
            </div>
            <div class=" w-full md:w-1/4 ">
                <SelectInput name="Order Dir" v-model="params.orderDir"
                    :options="[{value:'asc', label:'ASC'},{value:'desc', label:'DESC'}]"
                />
            </div>

        </div>
        <ExchangeRateListing v-for="(exchangeRate, index) in exchangeRates.data" :key="exchangeRate.id"
            :exchangeRate="exchangeRate" :index="index" :currentPage="exchangeRates.current_page"
            :perPage="exchangeRates.per_page" />
        <div>
            <Pagination :paginator="exchangeRates"/>
        </div>
    </div>

</template>
