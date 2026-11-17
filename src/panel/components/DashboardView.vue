<script lang="ts">
import { usePanel } from "kirbyuse";
import { computed, onBeforeUnmount, onMounted, ref } from "vue";

declare global {
  interface Window {
    iFrameResize?: (
      options: Record<string, unknown>,
      target: HTMLIFrameElement,
    ) => void;
  }

  interface HTMLIFrameElement {
    iFrameResizer?: { removeListeners: () => void };
  }
}

// Sizing options `embed.host.js` passes on its first load.
const IFRAME_RESIZER_OPTIONS = {
  heightCalculationMethod: "taggedElement",
  checkOrigin: false,
};

let embedHost: Promise<void> | undefined;

function loadEmbedHost(origin: string) {
  embedHost ??= new Promise((resolve, reject) => {
    const script = document.createElement("script");
    script.src = `${origin}/js/embed.host.js`;
    script.onload = () => resolve();
    script.onerror = () => {
      embedHost = undefined;
      script.remove();
      reject(new Error(`Failed to load ${script.src}`));
    };
    document.head.append(script);
  });

  return embedHost;
}
</script>

<script setup lang="ts">
const props = defineProps({
  sharedLink: {
    type: String,
    default: "",
  },
});

const panel = usePanel();
const iframe = ref<HTMLIFrameElement>();

const embedUrl = computed(() => {
  const url = new URL(props.sharedLink);
  url.searchParams.set("embed", "true");
  url.searchParams.set("theme", panel.theme.current);
  url.searchParams.set("background", "transparent");
  return url.href;
});

onMounted(async () => {
  if (!iframe.value) return;

  // The host script sizes every `[plausible-embed]` iframe when it first
  // loads; an iframe mounted after that is handed to it here.
  await loadEmbedHost(new URL(props.sharedLink).origin).catch(console.error);
  if (iframe.value && !iframe.value.iFrameResizer) {
    window.iFrameResize?.(IFRAME_RESIZER_OPTIONS, iframe.value);
  }
});

onBeforeUnmount(() => {
  iframe.value?.iFrameResizer?.removeListeners();
});
</script>

<template>
  <k-panel-inside>
    <k-header>{{ panel.t("johannschopplich.plausible.label") }}</k-header>
    <iframe
      v-if="sharedLink"
      ref="iframe"
      :src="embedUrl"
      class="k-plausible-view-iframe"
      plausible-embed
      scrolling="no"
      frameborder="0"
      loading="lazy"
    />
    <k-box
      v-else
      theme="empty"
      :text="panel.th('johannschopplich.plausible.sharedLinkMissing')"
    />
  </k-panel-inside>
</template>

<style>
.k-plausible-view-iframe {
  /* Spans the view plus the dashboard's own inline padding. */
  width: 1px;
  min-width: calc(100% + 3rem);
  margin-inline: -1.5rem;
  /* Until `embed.host.js` sizes the dashboard, or if it fails to load. */
  height: 2000px;
  /* A light color scheme keeps the transparent background transparent
     in a dark Panel, where browsers paint an opaque canvas otherwise. */
  color-scheme: light;
  background-color: transparent;
}
</style>
