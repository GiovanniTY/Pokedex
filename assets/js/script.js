import { compare } from "./component/compare.js";
import { favorite } from "./component/favorite.js";
import { filter } from "./component/filter.js";
import { popup } from "./component/popup.js";
import { navDetails } from "./component/nav.js";
import { setupAutocomplete } from "./component/autosuggestion.js"; 
import { toggleDarkMode } from "./component/darkmode.js";
import { animateProgressBar } from "./component/progressbar.js";



toggleDarkMode();
favorite();
filter();
compare();
popup();
navDetails();
 setupAutocomplete(); 
animateProgressBar();