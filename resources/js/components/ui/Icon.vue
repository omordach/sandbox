<template>
  <component :is="Resolved" v-bind="$attrs" />
</template>
<script setup lang="ts">
import { computed } from 'vue'
import {
  SunIcon,
  MoonIcon,
  CheckCircleIcon,
  XMarkIcon,
  ExclamationTriangleIcon,
  InformationCircleIcon,
  ArrowRightIcon,
} from '@heroicons/vue/24/solid'

type IconName = 'sun'|'moon'|'check'|'close'|'warning'|'info'|'arrow-right'
const props = defineProps<{ name: IconName }>()
const map: Record<IconName, any> = {
  sun: SunIcon,
  moon: MoonIcon,
  check: CheckCircleIcon,
  close: XMarkIcon,
  warning: ExclamationTriangleIcon,
  info: InformationCircleIcon,
  'arrow-right': ArrowRightIcon,
}
const Resolved = computed(() => map[props.name])
</script>

