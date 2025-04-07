<script>
const isKirby4 = window.panel.plugins.viewButtons === undefined;

function getSystemTheme() {
  if (isKirby4) {
    return "light";
  }

  return window.matchMedia("(prefers-color-scheme: dark)").matches
    ? "dark"
    : "light";
}

export default {
  props: {
    sharedLink: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      theme: getSystemTheme(),
    };
  },
  mounted() {
    this.updateTheme();
  },
  methods: {
    updateTheme() {
      const panelElement = document.querySelector(".k-panel");
      if (panelElement) {
        this.theme = panelElement.dataset.theme || getSystemTheme();
      }
    },
  },
};
</script>

<template>
  <k-panel-inside>
    <k-header>Plausible Analytics</k-header>
    <iframe
      v-if="sharedLink"
      :src="`${sharedLink}&embed=true&theme=${theme}&background=transparent`"
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
