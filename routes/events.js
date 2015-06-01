var express = require('express');
var router = express.Router();

/* GET events listing. */
router.get('/', function(req, res, next) {
    res.json({
        "event1": {
            "eventName": "Lorenzo"
        }
    });
});




module.exports = router;
