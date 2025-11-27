// Font Awesome core
import { library, dom } from "@fortawesome/fontawesome-svg-core";

// Icons
import { 
    faUser, 
    faHome, 
    faBell, 
    faThumbsUp,
    faCaretUp,
    faCaretDown,
    faCheck,
    faStar // ⭐ Solid star
} from "@fortawesome/free-solid-svg-icons";

import { 
    faHeart,
    faStar as faStarRegular // ☆ Regular star
} from "@fortawesome/free-regular-svg-icons";

import { 
    faFacebook, 
    faInstagram, 
    faTwitter 
} from "@fortawesome/free-brands-svg-icons";

// Add icons to the library
library.add(
    faUser, 
    faHome, 
    faBell, 
    faThumbsUp,
    faCaretUp,
    faCaretDown,
    faCheck,
    faStar,
    faStarRegular,
    faHeart, 
    faFacebook, 
    faInstagram, 
    faTwitter
);

// Auto replace <i> tags with SVG
dom.watch();
