import { usePage } from '@inertiajs/inertia-vue3'

export function getQuery() {
  return usePage().props.value.query
}
