<button
  @click="navOpen = !navOpen"
  type="button"
  class="block lg:hidden px-2 text-gray-500 hover:text-white focus:outline-none focus:text-white"
  :class="{ 'transition transform-180': navOpen }"
>
  <svg
    class="h-6 w-6 fill-current"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 24 24"
  >
    <path
      x-show="navOpen"
      fill-rule="evenodd"
      clip-rule="evenodd"
      d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"
    />
    <path
      x-show="!navOpen"
      fill-rule="evenodd"
      d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"
    />
  </svg>
</button>
