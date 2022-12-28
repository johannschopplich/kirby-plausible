import PlausibleView from "./components/PlausibleView.vue";

window.panel.plugin("katapult/panel-extensions", {
  components: {
    "k-plausible-view": PlausibleView,
  },
});
