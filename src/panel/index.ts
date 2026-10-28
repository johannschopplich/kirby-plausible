import PlausibleView from "./components/PlausibleView.vue";

window.panel.plugin("johannschopplich/plausible", {
  components: {
    "k-plausible-view": PlausibleView,
  },
});
