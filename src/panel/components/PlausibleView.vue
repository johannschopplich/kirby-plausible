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
  <KPanelInside>
    <KHeader>Plausible Analytics</KHeader>

    <iframe
      v-if="sharedLink"
      :src="`${sharedLink}&embed=true&theme=light&background=transparent`"
      plausible-embed
      scrolling="no"
      frameborder="0"
      loading="lazy"
    />
    <KBox v-else theme="negative">
      You need to set the <code>PLAUSIBLE_SHARED_LINK</code> environment
      variable in your <code>.env</code> file or
      <code>johannschopplich.plausible.sharedLink</code> in your
      <code>config.php</code>.
    </KBox>
  </KPanelInside>
</template>

<style scoped>
iframe {
  width: 1px;
  min-width: 100%;
  height: 1700px;
  /* Counterpart padding inside Plausible frame */
  margin-left: -1.5rem;
  margin-right: -1.5rem;
}

@media (max-width: 850px) {
  iframe {
    height: 2300px;
  }
}
</style>
