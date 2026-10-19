// eslint-disable-next-line ts/ban-ts-comment
// @ts-ignore The project declares no `*.vue` module, so the import has no type.
import PlausibleView from "./components/PlausibleView.vue";

window.panel.plugin("johannschopplich/plausible", {
  components: {
    "k-plausible-view": PlausibleView,
  },
});
