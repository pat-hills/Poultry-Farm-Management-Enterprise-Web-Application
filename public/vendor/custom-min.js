$(document).ready(function(){$("#smartwizard").smartWizard({selected:1,keyNavigation:!0,autoAdjustHeight:!0,cycleSteps:!1,backButtonSupport:!1,useURLhash:!1,lang:{next:"Next",previous:"Previous"},toolbarSettings:{toolbarPosition:"bottom",toolbarButtonPosition:"right",showNextButton:!0,showPreviousButton:!0,toolbarExtraButtons:[$("<button></button>").text("Finish").addClass("btn btn-primary").on("click",function(){alert("Finsih button click")})]},anchorSettings:{anchorClickable:!0,enableAllAnchors:!1,markDoneStep:!0,enableAnchorOnDoneStep:!1},contentURL:null,disabledSteps:[0],errorSteps:[],theme:"dots",transitionEffect:"fade",transitionSpeed:"400"})});