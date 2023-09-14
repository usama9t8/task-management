  
<script setup>
import Actions from './Actions.vue';
import { truncate } from 'lodash'
import { router } from '@inertiajs/vue3';

const props = defineProps({
    items: Array, // Pass the array of items as a prop
    columns: Array, // Pass the column configuration as a prop
    resource: String, //Pass resource(for actions) as a prop
    draggable: Boolean //Pass draggable(for reordering) as a prop
})

const dragStart = (index) => {
    event.dataTransfer.effectAllowed = 'move';
    event.dataTransfer.setData('text/plain', index);
}

const drop = (index) => {
    const draggedIndex = event.dataTransfer.getData('text/plain');
    const draggedItem = props.items[draggedIndex];
    props.items.splice(draggedIndex, 1);
    props.items.splice(index, 0, draggedItem);
    router.put(route('tasks.update-order', [props.items]));
}

</script>

<template>
    <div class="py-5">
        <div class="mx-auto xl:px-8">
            <div class="bg-white shadow rounded overflow-scroll">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 table table-auto leading-normal">
                    <thead class="text-gray-600 text-sm font-semibold bg-gray-200">
                        <tr class="table-row">
                            <th v-for="(column, columnIndex) in columns" :key="columnIndex"
                                :class="column.headerClass || 'text-left p-4'" :scope="column.scope || 'col'">
                                {{ column.label }}
                            </th>
                            <th scope="col" class="text-left p-4">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <tr v-for="(item, rowIndex) in items" :key="rowIndex" :draggable="draggable"
                            @dragstart="dragStart(rowIndex)" @dragover.prevent @drop="drop(rowIndex)"
                            :class="{ 'bg-white': rowIndex % 2 === 0, 'bg-gray-100': rowIndex % 2 !== 0 }"
                            class="border-t first:border-t-0 p-3 hover:bg-gray-100 table-row flex-col w-full flex-wrap">
                            <td v-for="(column, columnIndex) in columns" :key="columnIndex"
                                :class="column.cellClass || 'p-2 xl:p-4'">
                                <div>
                                    <p v-if="column.label === '#'">{{ rowIndex + 1 }}</p>
                                    <p v-else>{{ item[column.field]?.length > 25 ? truncate(item[column.field]) :
                                        item[column.field] }}</p>
                                </div>
                            </td>
                            <td>
                                <Actions :record="item" :resource="resource" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

  