import PlausibleView from "./components/PlausibleView.vue";

window.panel.plugin("johannschopplich/plausible", {
  components: {
    KPlausibleView: PlausibleView,
  },
});
