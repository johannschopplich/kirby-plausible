<script>
export default {
  props: {
    sharedLink: {
      type: String,
      required: true,
    },
  },
};
</script>

<template>
  <k-panel-inside>
    <k-header>Plausible Analytics</k-header>
    <iframe
      v-if="sharedLink"
      :src="`${sharedLink}&embed=true&theme=light&background=transparent`"
      plausible-embed
      scrolling="no"
      frameborder="0"
      loading="lazy"
    />
    <k-box v-else theme="empty">
      Missing <code>johannschopplich.plausible.sharedLink</code> property in
      your global Kirby configuration.
    </k-box>
  </k-panel-inside>
</template>

<style scoped>
iframe {
  width: 1px;
  min-width: 100%;
  height: 2000px;
  /* Counterpart padding inside Plausible frame */
  margin-left: -1.5rem;
  margin-right: -1.5rem;
}

@media (max-width: 850px) {
  iframe {
    height: 3050px;
  }
}
</style>
