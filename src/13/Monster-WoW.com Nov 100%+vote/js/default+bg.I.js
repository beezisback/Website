(function() {
var _UDS_CONST_LOCALE = 'bg';
var _UDS_CONST_SHORT_DATE_PATTERN = 'DMY';
var _UDS_MSG_SEARCHER_IMAGE = ('\u0418\u0437\u043e\u0431\u0440\u0430\u0436\u0435\u043d\u0438\u044f');
var _UDS_MSG_SEARCHER_WEB = ('\u041c\u0440\u0435\u0436\u0430\u0442\u0430');
var _UDS_MSG_SEARCHER_BLOG = ('\u0411\u043b\u043e\u0433');
var _UDS_MSG_SEARCHER_VIDEO = ('\u0412\u0438\u0434\u0435\u043e');
var _UDS_MSG_SEARCHER_LOCAL = ('\u041c\u0435\u0441\u0442\u043d\u0438');
var _UDS_MSG_SEARCHCONTROL_SAVE = ('\u0437\u0430\u043f\u0430\u0437\u0438');
var _UDS_MSG_SEARCHCONTROL_KEEP = ('\u0437\u0430\u043f\u0430\u0437\u0438');
var _UDS_MSG_SEARCHCONTROL_INCLUDE = ('\u0432\u043a\u043b\u044e\u0447\u0438\u0442\u0435\u043b\u043d\u043e');
var _UDS_MSG_SEARCHCONTROL_COPY = ('\u043a\u043e\u043f\u0438\u0440\u0430\u0439');
var _UDS_MSG_SEARCHCONTROL_CLOSE = ('\u0437\u0430\u0442\u0432\u043e\u0440\u0438');
var _UDS_MSG_SEARCHCONTROL_SPONSORED_LINKS = ('\u0421\u043f\u043e\u043d\u0441\u043e\u0440\u0438\u0440\u0430\u043d\u0438 \u0432\u0440\u044a\u0437\u043a\u0438');
var _UDS_MSG_SEARCHCONTROL_SEE_MORE = ('\u0432\u0438\u0436\u0442\u0435 \u043e\u0449\u0435...');
var _UDS_MSG_SEARCHCONTROL_WATERMARK = ('\u0432\u0437\u0435\u0442\u043e \u043e\u0442 Google');
var _UDS_MSG_SEARCHER_CONFIG_SET_LOCATION = ('\u041c\u044f\u0441\u0442\u043e \u043d\u0430 \u0442\u044a\u0440\u0441\u0435\u043d\u0435\u0442\u043e');
var _UDS_MSG_SEARCHER_CONFIG_DISABLE_ADDRESS_LOOKUP = ('\u041f\u0440\u0435\u043c\u0430\u0445\u043d\u0435\u0442\u0435 \u0442\u044a\u0440\u0441\u0435\u043d\u0435\u0442\u043e \u043f\u043e \u0430\u0434\u0440\u0435\u0441');
var _UDS_MSG_SEARCHER_NEWS = ('\u041d\u043e\u0432\u0438\u043d\u0438');
function _UDS_MSG_MINUTES_AGO(AGE_MINUTES_AGO) {return ('\u043f\u0440\u0435\u0434\u0438 ' + AGE_MINUTES_AGO + ' \u043c\u0438\u043d\u0443\u0442\u0438');}
var _UDS_MSG_ONE_HOUR_AGO = ('\u043f\u0440\u0435\u0434\u0438 1 \u0447\u0430\u0441');
function _UDS_MSG_HOURS_AGO(AGE_HOURS_AGO) {return ('\u043f\u0440\u0435\u0434\u0438 ' + AGE_HOURS_AGO + ' \u0447\u0430\u0441\u0430');}
function _UDS_MSG_NEWS_ALL_N_RELATED(NUMBER) {return ('\u0432\u0441\u0438\u0447\u043a\u0438 ' + NUMBER + ' \u0441\u0432\u044a\u0440\u0437\u0430\u043d\u0438');}
var _UDS_MSG_NEWS_RELATED = ('\u0421\u0432\u044a\u0440\u0437\u0430\u043d\u0438 \u0441\u0442\u0430\u0442\u0438\u0438');
var _UDS_MSG_BRANDING_STRING = ('\u0437\u0430\u0434\u0432\u0438\u0436\u0432\u0430\u043d\u043e \u043e\u0442 Google');
var _UDS_MSG_SORT_BY_DATE = ('\u041f\u043e\u0434\u0440\u0435\u0436\u0434\u0430\u043d\u0435 \u043f\u043e \u0434\u0430\u0442\u0430');
var _UDS_MSG_MONTH_ABBR_JAN = ('\u042f\u043d\u0443');
var _UDS_MSG_MONTH_ABBR_FEB = ('\u0424\u0435\u0432');
var _UDS_MSG_MONTH_ABBR_MAR = ('\u041c\u0430\u0440\u0442');
var _UDS_MSG_MONTH_ABBR_APR = ('\u0410\u043f\u0440');
var _UDS_MSG_MONTH_ABBR_MAY = ('\u041c\u0430\u0439');
var _UDS_MSG_MONTH_ABBR_JUN = ('\u042e\u043d\u0438');
var _UDS_MSG_MONTH_ABBR_JUL = ('\u042e\u043b\u0438');
var _UDS_MSG_MONTH_ABBR_AUG = ('\u0410\u0432\u0433');
var _UDS_MSG_MONTH_ABBR_SEP = ('\u0421\u0435\u043f\u0442');
var _UDS_MSG_MONTH_ABBR_OCT = ('\u041e\u043a\u0442');
var _UDS_MSG_MONTH_ABBR_NOV = ('\u041d\u043e\u0435');
var _UDS_MSG_MONTH_ABBR_DEC = ('\u0414\u0435\u043a');
var _UDS_MSG_DIRECTIONS = ('\u0443\u043f\u044a\u0442\u0432\u0430\u043d\u0435');
var _UDS_MSG_CLEAR_RESULTS = ('\u0438\u0437\u0447\u0438\u0441\u0442\u0438 \u0440\u0435\u0437\u0443\u043b\u0442\u0430\u0442\u0438\u0442\u0435');
var _UDS_MSG_SHOW_ONE_RESULT = ('\u043f\u043e\u043a\u0430\u0436\u0438 \u0441\u0430\u043c\u043e \u0435\u0434\u0438\u043d \u0440\u0435\u0437\u0443\u043b\u0442\u0430\u0442');
var _UDS_MSG_SHOW_MORE_RESULTS = ('\u043f\u043e\u043a\u0430\u0436\u0438 \u043e\u0449\u0435 \u0440\u0435\u0437\u0443\u043b\u0442\u0430\u0442\u0438');
var _UDS_MSG_SHOW_ALL_RESULTS = ('\u043f\u043e\u043a\u0430\u0436\u0438 \u0432\u0441\u0438\u0447\u043a\u0438 \u0440\u0435\u0437\u0443\u043b\u0442\u0430\u0442\u0438');
var _UDS_MSG_SETTINGS = ('\u043d\u0430\u0441\u0442\u0440\u043e\u0439\u043a\u0438');
var _UDS_MSG_SEARCH = ('\u0442\u044a\u0440\u0441\u0435\u043d\u0435');
var _UDS_MSG_SEARCH_UC = ('\u0422\u044a\u0440\u0441\u0438');
var _UDS_MSG_POWERED_BY = ('\u0437\u0430\u0445\u0440\u0430\u043d\u0432\u0430 \u0441\u0435 \u043e\u0442');
function _UDS_MSG_LOCAL_ATTRIBUTION(LOCAL_RESULTS_PROVIDER) {return ('\u0412\u043f\u0438\u0441\u0430\u043d\u0438\u0442\u0435 \u0444\u0438\u0440\u043c\u0438 \u0441\u0430 \u043e\u0441\u0438\u0433\u0443\u0440\u0435\u043d\u0438 \u043e\u0442 ' + LOCAL_RESULTS_PROVIDER);}
var _UDS_MSG_SEARCHER_BOOK = ('\u041a\u043d\u0438\u0433\u0430');
function _UDS_MSG_FOUND_ON_PAGE(FOUND_ON_PAGE) {return ('\u0421\u0442\u0440\u0430\u043d\u0438\u0446\u0430 ' + FOUND_ON_PAGE);}
function _UDS_MSG_TOTAL_PAGE_COUNT(PAGE_COUNT) {return ('' + PAGE_COUNT + ' \u0441\u0442\u0440\u0430\u043d\u0438\u0446\u0438');}
var _UDS_MSG_SEARCHER_BY = ('\u043e\u0442');
var _UDS_MSG_SEARCHER_CODE = ('\u041a\u043e\u0434');
var _UDS_MSG_UNKNOWN_LICENSE = ('\u041d\u0435\u0438\u0437\u0432\u0435\u0441\u0442\u0435\u043d \u043b\u0438\u0446\u0435\u043d\u0437');
var _UDS_MSG_SEARCHER_GSA = ('\u0422\u044a\u0440\u0441\u0430\u0447\u043a\u0430');
var _UDS_MSG_SEARCHCONTROL_MORERESULTS = ('\u041e\u0449\u0435 \u0440\u0435\u0437\u0443\u043b\u0442\u0430\u0442\u0438');
var _UDS_MSG_SEARCHCONTROL_PREVIOUS = ('\u041f\u0440\u0435\u0434\u0438\u0448\u043d\u0438');
var _UDS_MSG_SEARCHCONTROL_NEXT = ('\u0421\u043b\u0435\u0434\u0432\u0430\u0449\u0438');
var _UDS_MSG_GET_DIRECTIONS = ('\u0423\u043a\u0430\u0437\u0430\u043d\u0438\u044f \u0437\u0430 \u043f\u044a\u0442\u0443\u0432\u0430\u043d\u0435');
var _UDS_MSG_GET_DIRECTIONS_TO_HERE = ('\u0414\u043e');
var _UDS_MSG_GET_DIRECTIONS_FROM_HERE = ('\u041e\u0442');
var _UDS_MSG_CLEAR_RESULTS_UC = ('\u0418\u0437\u0447\u0438\u0441\u0442\u0432\u0430\u043d\u0435 \u043d\u0430 \u0440\u0435\u0437\u0443\u043b\u0442\u0430\u0442\u0438\u0442\u0435');
var _UDS_MSG_SEARCH_THE_MAP = ('\u0442\u044a\u0440\u0441\u0435\u0442\u0435 \u0432 \u043a\u0430\u0440\u0442\u0430\u0442\u0430');
var _UDS_MSG_SCROLL_THROUGH_RESULTS = ('\u043f\u0440\u0435\u043c\u0438\u043d\u0430\u0432\u0430\u043d\u0435 \u043f\u043e \u0440\u0435\u0437\u0443\u043b\u0442\u0430\u0442\u0438\u0442\u0435');
var _UDS_MSG_EDIT_TAGS = ('\u0440\u0435\u0434\u0430\u043a\u0442\u0438\u0440\u0430\u0439\u0442\u0435 \u0442\u0430\u0433\u043e\u0432\u0435\u0442\u0435');
var _UDS_MSG_TAG_THIS_SEARCH = ('\u0437\u0430\u043f\u0430\u043c\u0435\u0442\u044f\u0432\u0430\u043d\u0435 \u043d\u0430 \u0442\u043e\u0432\u0430 \u0442\u044a\u0440\u0441\u0435\u043d\u0435');
var _UDS_MSG_SEARCH_STRING = ('\u0441\u0442\u0440\u0438\u043d\u0433 \u043d\u0430 \u0442\u044a\u0440\u0441\u0435\u043d\u0435');
var _UDS_MSG_OPTIONAL_LABEL = ('\u0435\u0442\u0438\u043a\u0435\u0442 \u043f\u043e \u0438\u0437\u0431\u043e\u0440');
var _UDS_MSG_DELETE = ('\u0438\u0437\u0442\u0440\u0438\u0432\u0430\u043d\u0435');
var _UDS_MSG_DELETED = ('\u0438\u0437\u0442\u0440\u0438\u0442\u043e');
var _UDS_MSG_CANCEL = ('\u043e\u0442\u043c\u044f\u043d\u0430');
var _UDS_MSG_UPLOAD_YOUR_VIDEOS = ('\u043a\u0430\u0447\u0435\u0442\u0435 \u0441\u043e\u0431\u0441\u0442\u0432\u0435\u043d \u0432\u0438\u0434\u0435\u043e\u043c\u0430\u0442\u0435\u0440\u0438\u0430\u043b');
var _UDS_MSG_IM_DONE_WATCHING = ('\u043f\u0440\u0438\u043a\u043b\u044e\u0447\u0438\u0445 \u0441 \u0433\u043b\u0435\u0434\u0430\u043d\u0435\u0442\u043e');
var _UDS_MSG_CLOSE_VIDEO_PLAYER = ('\u0437\u0430\u0442\u0432\u0430\u0440\u044f\u043d\u0435 \u043d\u0430 \u0432\u0438\u0434\u0435\u043e \u043f\u043b\u0435\u044a\u0440\u0430');
var _UDS_MSG_NO_RESULTS = ('\u041d\u044f\u043c\u0430 \u0440\u0435\u0437\u0443\u043b\u0442\u0430\u0442\u0438');
var _UDS_MSG_LINKEDCSE_ERROR_RESULTS = ('\u0422\u0430\u0437\u0438 \u043f\u043e\u0442\u0440\u0435\u0431\u0438\u0442\u0435\u043b\u0441\u043a\u0430 \u0442\u044a\u0440\u0441\u0430\u0447\u043a\u0430 \u0441\u0435 \u0437\u0430\u0440\u0435\u0436\u0434\u0430. \u041e\u043f\u0438\u0442\u0430\u0439\u0442\u0435 \u043f\u0430\u043a \u0441\u043b\u0435\u0434 \u043d\u044f\u043a\u043e\u043b\u043a\u043e \u0441\u0435\u043a\u0443\u043d\u0434\u0438.');
var _UDS_MSG_COUPONS = ('\u041a\u0443\u043f\u043e\u043d\u0438');
var _UDS_MSG_BACK = ('\u043d\u0430\u0437\u0430\u0434');
var _UDS_MSG_SUBSCRIBE = ('\u0410\u0431\u043e\u043d\u0438\u0440\u0430\u0439\u0442\u0435 \u0441\u0435');
var _UDS_MSG_SEARCHER_PATENT = ('\u041f\u0430\u0442\u0435\u043d\u0442');
var _UDS_MSG_USPAT = ('\u0421\u0410\u0429 \u041f\u0430\u0442\u0435\u043d\u0442 \u2116:');
var _UDS_MSG_USPAT_APP = ('\u0421\u0410\u0429 \u0417\u0430\u044f\u0432\u043b\u0435\u043d\u0438\u0435 \u0437\u0430 \u043f\u0430\u0442\u0435\u043d\u0442 \u2116:');
var _UDS_MSG_PATENT_FILED = ('\u0420\u0435\u0433\u0438\u0441\u0442\u0440\u0438\u0440\u0430\u043d \u043d\u0430');
var _UDS_MSG_ADS_BY_GOOGLE = ('\u0420\u0435\u043a\u043b\u0430\u043c\u0438 \u0441 Google');
var _UDS_MSG_SET_DEFAULT_LOCATION = ('\u0417\u0430\u0434\u0430\u0432\u0430\u043d\u0435 \u043d\u0430 \u0441\u0442\u0430\u043d\u0434\u0430\u0440\u0442\u043d\u043e \u043c\u0435\u0441\u0442\u043e\u043f\u043e\u043b\u043e\u0436\u0435\u043d\u0438\u0435');
var _UDS_MSG_NEWSCAT_TOPSTORIES = ('\u0412\u043e\u0434\u0435\u0449\u0438 \u043c\u0430\u0442\u0435\u0440\u0438\u0430\u043b\u0438');
var _UDS_MSG_NEWSCAT_WORLD = ('\u041f\u043e \u0441\u0432\u0435\u0442\u0430');
var _UDS_MSG_NEWSCAT_NATION = ('\u041d\u0430\u0446\u0438\u044f');
var _UDS_MSG_NEWSCAT_BUSINESS = ('\u0411\u0438\u0437\u043d\u0435\u0441');
var _UDS_MSG_NEWSCAT_SCITECH = ('\u041d\u0430\u0443\u043a\u0430 \u0438 \u0442\u0435\u0445\u043d\u043e\u043b\u043e\u0433\u0438\u0438');
var _UDS_MSG_NEWSCAT_ENTERTAINMENT = ('\u0428\u043e\u0443\u0431\u0438\u0437\u043d\u0435\u0441');
var _UDS_MSG_NEWSCAT_HEALTH = ('\u0417\u0434\u0440\u0430\u0432\u0435');
var _UDS_MSG_NEWSCAT_SPORTS = ('\u0421\u043f\u043e\u0440\u0442');
var _UDS_MSG_NEWSCAT_POLITICS = ('\u041f\u043e\u043b\u0438\u0442\u0438\u043a\u0430');
var _UDS_MSG_SEARCH_RESULTS = ('\u0420\u0435\u0437\u0443\u043b\u0442\u0430\u0442\u0438 \u043e\u0442 \u0442\u044a\u0440\u0441\u0435\u043d\u0435');
var _UDS_MSG_DID_YOU_MEAN = ('\u041c\u043e\u0436\u0435 \u0431\u0438 \u0438\u043c\u0430\u0445\u0442\u0435 \u043f\u0440\u0435\u0434\u0432\u0438\u0434:');
var _UDS_MSG_CUSTOM_SEARCH = ('\u041f\u0435\u0440\u0441\u043e\u043d\u0430\u043b\u0438\u0437\u0438\u0440\u0430\u043d\u043e \u0442\u044a\u0440\u0441\u0435\u043d\u0435');
var _UDS_MSG_LABELED = ('\u0421 \u0435\u0442\u0438\u043a\u0435\u0442');
var _UDS_MSG_LOADING = ('\u0417\u0430\u0440\u0435\u0436\u0434\u0430 \u0441\u0435\u2026');
var _UDS_MSG_ALL_RESULTS_SHORT = ('\u0412\u0441\u0438\u0447\u043a\u0438');
var _UDS_MSG_ALL_RESULTS_LONG = ('\u0412\u0441\u0438\u0447\u043a\u0438 \u0440\u0435\u0437\u0443\u043b\u0442\u0430\u0442\u0438');
var _UDS_MSG_REFINE_RESULTS = ('\u041f\u0440\u0435\u0446\u0438\u0437\u0438\u0440\u0430\u043d\u0435 \u043d\u0430 \u0440\u0435\u0437\u0443\u043b\u0442\u0430\u0442\u0438\u0442\u0435:');
function _UDS_MSG_REVIEWS(REVIEW_COUNT) {return ('' + REVIEW_COUNT + ' \u043e\u0442\u0437\u0438\u0432\u0430');}
function _UDS_MSG_CALORIES(CALORIES) {return ('' + CALORIES + ' \u043a\u0430\u043b.');}
function _UDS_MSG_PRICE_RANGE(RANGE) {return ('\u0426\u0435\u043d\u043e\u0432\u0438 \u0434\u0438\u0430\u043f\u0430\u0437\u043e\u043d: ' + RANGE + '.');}
function _UDS_MSG_PRICE(PRICE) {return ('\u0426\u0435\u043d\u0430: ' + PRICE + '.');}
function _UDS_MSG_AVAILABILITY(AVAILABILITY) {return ('\u041d\u0430\u043b\u0438\u0447\u043d\u043e\u0441\u0442: ' + AVAILABILITY + '.');}
function _UDS_MSG_TELEPHONE(TELEPHONE) {return ('\u0422\u0435\u043b.: ' + TELEPHONE);}
function _UDS_MSG_RESULT_INFO(NUMBER_OF_RESULTS, SEARCH_TIME) {return ('\u041e\u043a\u043e\u043b\u043e ' + NUMBER_OF_RESULTS + ' \u0440\u0435\u0437\u0443\u043b\u0442\u0430\u0442\u0430 (' + SEARCH_TIME + ' \u0441\u0435\u043a\u0443\u043d\u0434\u0438)');}
var _UDS_MSG_FILE_FORMAT = ('\u0424\u0430\u0439\u043b\u043e\u0432 \u0444\u043e\u0440\u043c\u0430\u0442:');
var _UDS_MSG_SHOWING_RESULTS_FOR = ('\u041f\u043e\u043a\u0430\u0437\u0430\u043d\u0438\u0442\u0435 \u0440\u0435\u0437\u0443\u043b\u0442\u0430\u0442\u0438 \u0441\u0430 \u0437\u0430');
var _UDS_MSG_SEARCH_INSTEAD_FOR = ('\u0412\u043c\u0435\u0441\u0442\u043e \u0442\u043e\u0432\u0430 \u0434\u0430 \u0441\u0435 \u0442\u044a\u0440\u0441\u0438');
function _UDS_MSG_FILTERED_RESULTS(NUM) {return ('\u0417\u0430 \u0434\u0430 \u0432\u0438 \u043f\u043e\u043a\u0430\u0436\u0435\u043c \u043d\u0430\u0439-\u043f\u043e\u0434\u0445\u043e\u0434\u044f\u0449\u0438\u0442\u0435 \u0440\u0435\u0437\u0443\u043b\u0442\u0430\u0442\u0438, \u043f\u0440\u043e\u043f\u0443\u0441\u043d\u0430\u0445\u043c\u0435 \u043d\u044f\u043a\u043e\u0438, \u043a\u043e\u0438\u0442\u043e \u0441\u0430 \u043c\u043d\u043e\u0433\u043e \u043f\u043e\u0434\u043e\u0431\u043d\u0438 \u043d\u0430 \u0438\u0437\u0432\u0435\u0434\u0435\u043d\u0438\u0442\u0435 ' + NUM + '. \u0410\u043a\u043e \u0438\u0441\u043a\u0430\u0442\u0435, \u043c\u043e\u0436\u0435\u0442\u0435 ' + '<a>\u0434\u0430 \u043f\u043e\u0432\u0442\u043e\u0440\u0438\u0442\u0435 \u0442\u044a\u0440\u0441\u0435\u043d\u0435\u0442\u043e \u0437\u0430\u0435\u0434\u043d\u043e \u0441 \u043f\u0440\u043e\u043f\u0443\u0441\u043d\u0430\u0442\u0438\u0442\u0435 \u0440\u0435\u0437\u0443\u043b\u0442\u0430\u0442\u0438' + '</a>.');}
var _UDS_MSG_ORDER_BY = ('\u0421\u043e\u0440\u0442\u0438\u0440\u0430\u043d\u0435 \u043f\u043e:');
var _UDS_MSG_ORDER_BY_RELEVANCE = ('\u0423\u043c\u0435\u0441\u0442\u043d\u043e\u0441\u0442');
var _UDS_MSG_ORDER_BY_DATE = ('\u0414\u0430\u0442\u0430');

var b=!0,g=null,i=encodeURIComponent,j=google_exportSymbol,k=window,l=document,m=navigator,n="appendChild",p="push",q="status",r="createElement",s="ServiceBase",t="length",u="language",v="style",w="loader",x={blank:"&nbsp;"};x.image=_UDS_MSG_SEARCHER_IMAGE;x.web=_UDS_MSG_SEARCHER_WEB;x.blog=_UDS_MSG_SEARCHER_BLOG;x.video=_UDS_MSG_SEARCHER_VIDEO;x.local=_UDS_MSG_SEARCHER_LOCAL;x.news=_UDS_MSG_SEARCHER_NEWS;x.book=_UDS_MSG_SEARCHER_BOOK;x.patent=_UDS_MSG_SEARCHER_PATENT;x["ads-by-google"]=_UDS_MSG_ADS_BY_GOOGLE;
x.save=_UDS_MSG_SEARCHCONTROL_SAVE;x.keep=_UDS_MSG_SEARCHCONTROL_KEEP;x.include=_UDS_MSG_SEARCHCONTROL_INCLUDE;x.copy=_UDS_MSG_SEARCHCONTROL_COPY;x.close=_UDS_MSG_SEARCHCONTROL_CLOSE;x["sponsored-links"]=_UDS_MSG_SEARCHCONTROL_SPONSORED_LINKS;x["see-more"]=_UDS_MSG_SEARCHCONTROL_SEE_MORE;x.watermark=_UDS_MSG_SEARCHCONTROL_WATERMARK;x["search-location"]=_UDS_MSG_SEARCHER_CONFIG_SET_LOCATION;x["disable-address-lookup"]=_UDS_MSG_SEARCHER_CONFIG_DISABLE_ADDRESS_LOOKUP;x["sort-by-date"]=_UDS_MSG_SORT_BY_DATE;
x.pbg=_UDS_MSG_BRANDING_STRING;x["n-minutes-ago"]=_UDS_MSG_MINUTES_AGO;x["n-hours-ago"]=_UDS_MSG_HOURS_AGO;x["one-hour-ago"]=_UDS_MSG_ONE_HOUR_AGO;x["all-n-related"]=_UDS_MSG_NEWS_ALL_N_RELATED;x["related-articles"]=_UDS_MSG_NEWS_RELATED;x["page-count"]=_UDS_MSG_TOTAL_PAGE_COUNT;var y=[];y[0]=_UDS_MSG_MONTH_ABBR_JAN;y[1]=_UDS_MSG_MONTH_ABBR_FEB;y[2]=_UDS_MSG_MONTH_ABBR_MAR;y[3]=_UDS_MSG_MONTH_ABBR_APR;y[4]=_UDS_MSG_MONTH_ABBR_MAY;y[5]=_UDS_MSG_MONTH_ABBR_JUN;y[6]=_UDS_MSG_MONTH_ABBR_JUL;y[7]=_UDS_MSG_MONTH_ABBR_AUG;
y[8]=_UDS_MSG_MONTH_ABBR_SEP;y[9]=_UDS_MSG_MONTH_ABBR_OCT;y[10]=_UDS_MSG_MONTH_ABBR_NOV;y[11]=_UDS_MSG_MONTH_ABBR_DEC;x["month-abbr"]=y;x.directions=_UDS_MSG_DIRECTIONS;x["clear-results"]=_UDS_MSG_CLEAR_RESULTS;x["show-one-result"]=_UDS_MSG_SHOW_ONE_RESULT;x["show-more-results"]=_UDS_MSG_SHOW_MORE_RESULTS;x["show-all-results"]=_UDS_MSG_SHOW_ALL_RESULTS;x.settings=_UDS_MSG_SETTINGS;x.search=_UDS_MSG_SEARCH;x["search-uc"]=_UDS_MSG_SEARCH_UC;x["powered-by"]=_UDS_MSG_POWERED_BY;x.sa=_UDS_MSG_SEARCHER_GSA;
x.by=_UDS_MSG_SEARCHER_BY;x.code=_UDS_MSG_SEARCHER_CODE;x["unknown-license"]=_UDS_MSG_UNKNOWN_LICENSE;x["more-results"]=_UDS_MSG_SEARCHCONTROL_MORERESULTS;x.previous=_UDS_MSG_SEARCHCONTROL_PREVIOUS;x.next=_UDS_MSG_SEARCHCONTROL_NEXT;x["get-directions"]=_UDS_MSG_GET_DIRECTIONS;x["to-here"]=_UDS_MSG_GET_DIRECTIONS_TO_HERE;x["from-here"]=_UDS_MSG_GET_DIRECTIONS_FROM_HERE;x["clear-results-uc"]=_UDS_MSG_CLEAR_RESULTS_UC;x["search-the-map"]=_UDS_MSG_SEARCH_THE_MAP;x["scroll-results"]=_UDS_MSG_SCROLL_THROUGH_RESULTS;
x["edit-tags"]=_UDS_MSG_EDIT_TAGS;x["tag-search"]=_UDS_MSG_TAG_THIS_SEARCH;x["search-string"]=_UDS_MSG_SEARCH_STRING;x["optional-label"]=_UDS_MSG_OPTIONAL_LABEL;x["delete"]=_UDS_MSG_DELETE;x.deleted=_UDS_MSG_DELETED;x.cancel=_UDS_MSG_CANCEL;x["upload-video"]=_UDS_MSG_UPLOAD_YOUR_VIDEOS;x["im-done"]=_UDS_MSG_IM_DONE_WATCHING;x["close-player"]=_UDS_MSG_CLOSE_VIDEO_PLAYER;x["no-results"]=_UDS_MSG_NO_RESULTS;x["linked-cse-error-results"]=_UDS_MSG_LINKEDCSE_ERROR_RESULTS;x.back=_UDS_MSG_BACK;
x.subscribe=_UDS_MSG_SUBSCRIBE;x["us-pat"]=_UDS_MSG_USPAT;x["us-pat-app"]=_UDS_MSG_USPAT_APP;x["us-pat-filed"]=_UDS_MSG_PATENT_FILED;x.dym=_UDS_MSG_DID_YOU_MEAN;x["showing-results-for"]=_UDS_MSG_SHOWING_RESULTS_FOR;x["search-instead-for"]=_UDS_MSG_SEARCH_INSTEAD_FOR;x["custom-search"]=_UDS_MSG_CUSTOM_SEARCH;x.labeled=_UDS_MSG_LABELED;x.loading=_UDS_MSG_LOADING;x["all-results-short"]=_UDS_MSG_ALL_RESULTS_SHORT;x["all-results-long"]=_UDS_MSG_ALL_RESULTS_LONG;x["refine-results"]=_UDS_MSG_REFINE_RESULTS;
x["result-info"]=_UDS_MSG_RESULT_INFO;x["file-format"]=_UDS_MSG_FILE_FORMAT;x["order-results-by"]="Sort by:";x["order-by-relevance"]="Relevance";x["order-by-date"]="Date";var _json_cache_defeater_=(new Date).getTime(),_json_request_require_prep=b;function z(a,e){if(A("msie")&&("msie 6.0"in B?B["msie 6.0"]:B["msie 6.0"]=-1!=m.appVersion.toLowerCase().indexOf("msie 6.0"))){var c=this,d=C,f=[a,e];k.setTimeout(function(){return d.apply(c,f||[])},0)}else C(a,e)}
function C(a,e){var c=l.getElementsByTagName("head")[0];c||(c=l.body.parentNode[n](l[r]("head")));var d=l[r]("script");d.type="text/javascript";d.charset="utf-8";var f=_json_request_require_prep?a+"&key="+google[w].ApiKey+"&v="+e:a;if(A("msie")||A("safari")||A("konqueror"))f=f+"&nocache="+_json_cache_defeater_++;d.src=f;var h=function(){d.onload=g;d.parentNode.removeChild(d)},f=function(a){a=(a?a:k.event).target?(a?a:k.event).target:(a?a:k.event).srcElement;if("loaded"==a.readyState||"complete"==
a.readyState)a.onreadystatechange=g,h()};"Gecko"==m.product?d.onload=h:d.onreadystatechange=f;c[n](d)}function A(a){return a in D?D[a]:D[a]=-1!=m.userAgent.toLowerCase().indexOf(a)}var D={},B={},E,F;k.ActiveXObject&&(E=b,k.XMLHttpRequest&&(F=b));if(!G)var G=j;if(!H)var H=google_exportProperty;
google[u].d={AFRIKAANS:"af",ALBANIAN:"sq",AMHARIC:"am",ARABIC:"ar",ARMENIAN:"hy",AZERBAIJANI:"az",BASQUE:"eu",BELARUSIAN:"be",BENGALI:"bn",BIHARI:"bh",BULGARIAN:"bg",BURMESE:"my",BRETON:"br",CATALAN:"ca",CHEROKEE:"chr",CHINESE:"zh",CHINESE_SIMPLIFIED:"zh-CN",CHINESE_TRADITIONAL:"zh-TW",CORSICAN:"co",CROATIAN:"hr",CZECH:"cs",DANISH:"da",DHIVEHI:"dv",DUTCH:"nl",ENGLISH:"en",ESPERANTO:"eo",ESTONIAN:"et",FAROESE:"fo",FILIPINO:"tl",FINNISH:"fi",FRENCH:"fr",FRISIAN:"fy",GALICIAN:"gl",GEORGIAN:"ka",GERMAN:"de",
GREEK:"el",GUJARATI:"gu",HAITIAN_CREOLE:"ht",HEBREW:"iw",HINDI:"hi",HUNGARIAN:"hu",ICELANDIC:"is",INDONESIAN:"id",INUKTITUT:"iu",IRISH:"ga",ITALIAN:"it",JAPANESE:"ja",JAVANESE:"jw",KANNADA:"kn",KAZAKH:"kk",KHMER:"km",KOREAN:"ko",KURDISH:"ku",KYRGYZ:"ky",LAO:"lo",LAOTHIAN:"lo",LATIN:"la",LATVIAN:"lv",LITHUANIAN:"lt",LUXEMBOURGISH:"lb",MACEDONIAN:"mk",MALAY:"ms",MALAYALAM:"ml",MALTESE:"mt",MAORI:"mi",MARATHI:"mr",MONGOLIAN:"mn",NEPALI:"ne",NORWEGIAN:"no",OCCITAN:"oc",ORIYA:"or",PASHTO:"ps",PERSIAN:"fa",
POLISH:"pl",PORTUGUESE:"pt",PORTUGUESE_PORTUGAL:"pt-PT",PUNJABI:"pa",QUECHUA:"qu",ROMANIAN:"ro",RUSSIAN:"ru",SANSKRIT:"sa",SCOTS_GAELIC:"gd",SERBIAN:"sr",SINDHI:"sd",SINHALESE:"si",SLOVAK:"sk",SLOVENIAN:"sl",SPANISH:"es",SUNDANESE:"su",SWAHILI:"sw",SWEDISH:"sv",SYRIAC:"syr",TAJIK:"tg",TAMIL:"ta",TAGALOG:"tl",TATAR:"tt",TELUGU:"te",THAI:"th",TIBETAN:"bo",TONGA:"to",TURKISH:"tr",UKRAINIAN:"uk",URDU:"ur",UZBEK:"uz",UIGHUR:"ug",VIETNAMESE:"vi",WELSH:"cy",YIDDISH:"yi",YORUBA:"yo",UNKNOWN:""};
G("google.language.Languages",google[u].d);
var I={AMHARIC:"am",ARMENIAN:"hy",AZERBAIJANI:"az",BASQUE:"eu",BENGALI:"bn",BIHARI:"bh",BRETON:"br",BURMESE:"my",CHEROKEE:"chr",CORSICAN:"co",DHIVEHI:"dv",ESPERANTO:"eo",FAROESE:"fo",FRISIAN:"fy",GEORGIAN:"ka",GUJARATI:"gu",INUKTITUT:"iu",JAVANESE:"jw",KANNADA:"kn",KAZAKH:"kk",KHMER:"km",KURDISH:"ku",KYRGYZ:"ky",LAO:"lo",LAOTHIAN:"lo",LATIN:"la",LUXEMBOURGISH:"lb",MALAYALAM:"ml",MAORI:"mi",MARATHI:"mr",MONGOLIAN:"mn",NEPALI:"ne",OCCITAN:"oc",ORIYA:"or",PASHTO:"ps",PUNJABI:"pa",QUECHUA:"qu",SANSKRIT:"sa",
SCOTS_GAELIC:"gd",SINDHI:"sd",SINHALESE:"si",SUNDANESE:"su",SYRIAC:"syr",TAJIK:"tg",TAMIL:"ta",TATAR:"tt",TELUGU:"te",TIBETAN:"bo",TONGA:"to",UIGHUR:"ug",URDU:"ur",UZBEK:"uz",YORUBA:"yo"},J={},K={},L=100;function M(a,e){var c="id"+L++;K[c]=function(d,f,h,R,T){d=e(d,f,h,R,T);a(d);delete K[c]};return"google.language.callbacks."+c}google[u].k=function(a){return J[a]};G("google.language.isTranslatable",google[u].k);for(var N in google[u].d)J[google[u].d[N]]=b;for(N in I)J[I[N]]=!1;
j("google.language.callbacks",K);
j("google.language.getBranding",function(a,e){var c="horizontal";e&&e.type&&(c=e.orientation);var d=x["powered-by"],f=google[w][s]+"/css/small-logo"+(E&&!F?".gif":".png"),h=['<div style="font-family:arial,sans-serif;','font-size:11px;margin-bottom:1px" class="gBrandingText">',d,'</div><div><img src="',f,'"/></div>'],d=['<span style="vertical-align:middle;font-family:arial,sans-serif;','font-size:11px;" class="gBrandingText">',d,'<img style="padding-left:1px;vertical-align:',E?'bottom;" ':'middle;" ',
'src="',f,'"/></span>'],d="horizontal"==c?d:h,f=d.join(""),c=l[r]("div");c.className="gBranding";c[v].color="#676767";d==h&&(c[v].textAlign="center");c.innerHTML=f;a&&(h=g,(h="string"==typeof a?l.getElementById(a):a)&&h[n]&&h[n](c));return c});j("google.language.HORIZONTAL_BRANDING","horizontal");j("google.language.VERTICAL_BRANDING","vertical");j("google.language.CurrentLocale",_UDS_CONST_LOCALE);j("google.language.ShortDatePattern",_UDS_CONST_SHORT_DATE_PATTERN);google[u].l=function(a,e,c){var d=O,f="id"+L++;K[f]=function(a){a=d(a);e(a);delete K[f]};var h;h="http://www.google.com/complete/search"+("?json=t&jsonp=google.language.callbacks."+f+"&client=uds");c&&(h+="&hl="+i(c));h+="&q="+i(a);_json_request_require_prep=!1;z(h,g);_json_request_require_prep=b};G("google.language.suggest",google[u].l);
function O(a){var e={};e.query=a[0];e.suggestions=[];for(var c=a[1],a=a[2],d=0;d<c[t];d++){var f={};f.name=c[d];f.count=parseInt(a[d].replace(",",""),10);f.results=a[d];e.suggestions[p](f)}return e};google[u].f={TEXT:"text",HTML:"html"};G("google.language.ContentType",google[u].f);google[u].translate=function(a,e,c,d){var f,h=g;if("string"==typeof a)f=a;else if(a.text&&a.type)f=a.text,h=a.type;else throw"Invalid first argument";5120>=f[t]?a=!1:(a=P(g,g,400,"the string to be translated exceeds the maximum length allowed",g),d(a),a=b);a||(d=M(d,P),d=google[w][s]+"/Gtranslate?callback="+d,d=d+"&context=22"+("&q="+i(f)),d+="&langpair="+i(e+"|"+c),h&&(d+="&format="+i(h)),z(d,google[u].Version))};
G("google.language.translate",google[u].translate);function P(a,e,c,d){a={};a.status={code:c};d&&(a[q].message=d);200!=c?(a.error=a[q],a.translation=""):(a.translation=e.translatedText,e.detectedSourceLanguage&&(a.detectedSourceLanguage=e.detectedSourceLanguage));return a}google[u].i=function(a,e){var c=M(e,Q),c=google[w][s]+"/GlangDetect?callback="+c,c=c+"&context=22"+("&q="+i(a));z(c,google[u].Version)};G("google.language.detect",google[u].i);
function Q(a,e,c,d){a={};a.status={code:c};d&&(a[q].message=d);200!=c?(a.error=a[q],a.language=""):(a.language=e[u],a.isReliable=e.isReliable,a.confidence=e.confidence);return a};var S={"en|am":b,"en|ar":b,"en|bn":b,"en|el":b,"en|fa":b,"en|gu":b,"en|hi":b,"en|kn":b,"en|ml":b,"en|mr":b,"en|ne":b,"en|or":b,"en|pa":b,"en|ru":b,"en|sa":b,"en|si":b,"en|sr":b,"en|ta":b,"en|te":b,"en|ti":b,"en|ur":b,"en|zh":b};
google[u].m=function(a,e,c,d){if("function"!=typeof d)throw"Invalid callback";var f;f="";"object"!=typeof a||!a[t]?f="Words needs to be an array.":1>a[t]?f="No words to transliterate.":5<a[t]?f="Number of words to transliterate exceeds the limit of 5":e?c?e&&c&&S[e+"|"+c]||(f="Transliteration not supported for the language pair. Source Language - "+e+" Destination Language - "+c+"."):f="Destination language not specified.":f="Source language not specified.";if(0<f[t]){var h=U(g,g,400,f,g);k.setTimeout(function(){d(h)},
0);f=!1}else f=b;if(f){f=M(d,U);e=[google[w][s],"/Gtransliterate?callback=",f,"&context=22","&langpair=",i(e+"|"+c)];for(c=0;c<a[t];c++)e[p]("&q="),e[p](i(a[c]));z(e.join(""),google[u].Version)}};G("google.language.transliterate",google[u].m);function U(a,e,c,d){a={status:{code:c,message:d}};200!=c?(a.error=a[q],a.transliterations=[]):a.transliterations=e.transliterations;return a};var V={hi:b,kn:b,ml:b,ta:b,te:b};google[u].c={h:0,g:1,e:2};google[u].j=function(a){a=a.toLowerCase();return a in V?W(a):google[u].c.e};G("google.language.FontRenderingStatus.SUPPORTED",google[u].c.g);G("google.language.FontRenderingStatus.UNSUPPORTED",google[u].c.h);G("google.language.FontRenderingStatus.UNKNOWN",google[u].c.e);G("google.language.isFontRenderingSupported",google[u].j);
function W(a){switch(a){case "ml":return a=[],a[p]({a:"\u0d23\u0d28\u0d4d\u200d",b:"\u0d23\u0d4d\u0d23\u0d28\u0d4d\u0d31"}),a[p]({a:"\u0d23\u0d28\u0d4d\u200d",b:"\u0d23\u0d4d\u0d23\u0d28\u0d4d\u200d\u0d31"}),X(a);case "hi":return X([{a:"\u0915\u094d\u0930\u0930\u094d\u0925",b:"\u0915\u0925"}]);case "kn":return X([{a:"\u0c95\u0ccd\u0cb2",b:"\u0c95"}]);case "te":return X([{a:"\u0c15\u0c4d\u0c32",b:"\u0c15"}]);case "ta":return X([{a:"\u0b95\u0bcd",b:"\u0b95"}])}}
function X(a){for(var e=0;e<a[t];e++){var c=a[e],d=c.a,f=c.b,c=l[r]("span");c[v].fontSize="10px";var h=c[v];"opacity"in h?h.opacity=0.1:"MozOpacity"in h?h.MozOpacity=0.1:"filter"in h&&(h.filter="alpha(opacity=10)");l.body[n](c);c.innerHTML=d;d=Y(c).width;c.innerHTML=f;f=Y(c).width;l.body.removeChild(c);if(d==f)return b}return!1}
function Y(a){if("none"!=a[v].display)return{width:a.offsetWidth,height:a.offsetHeight};var e=a[v],c=e.display,d=e.visibility,f=e.position;e.visibility="hidden";e.position="absolute";e.display="";var h=a.offsetWidth,a=a.offsetHeight;e.display=c;e.position=f;e.visibility=d;return{width:h,height:a}};
google.loader.loaded({"module":"language","version":"1.0","components":["default"]});
google.loader.eval.language = function() {eval(arguments[0]);};if (google.loader.eval.scripts && google.loader.eval.scripts['language']) {(function() {var scripts = google.loader.eval.scripts['language'];for (var i = 0; i < scripts.length; i++) {google.loader.eval.language(scripts[i]);}})();google.loader.eval.scripts['language'] = null;}})();