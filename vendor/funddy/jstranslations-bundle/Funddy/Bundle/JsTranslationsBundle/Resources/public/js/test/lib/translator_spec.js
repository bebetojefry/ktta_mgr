// Generated by CoffeeScript 1.4.0
(function() {

  describe("Translator", function() {
    var IRRELEVANT_TRANSLATION, dummyInterval, intervalParserStub, translationsData, translator;
    IRRELEVANT_TRANSLATION = "XXXX";
    translationsData = {
      "es": {
        "id1": IRRELEVANT_TRANSLATION,
        "id2": "%parameter%",
        "id3": "{0} There is no apples|{1} There is one apple|]1,Inf[ There are %count% apples"
      }
    };
    dummyInterval = null;
    intervalParserStub = null;
    translator = null;
    beforeEach(function() {
      dummyInterval = new FUNDDY.JsTranslations.Interval("{", "3", "3", "}");
      intervalParserStub = new FUNDDY.JsTranslations.IntervalParser();
      return translator = new FUNDDY.JsTranslations.Translator(intervalParserStub, translationsData, "es");
    });
    describe("#trans()", function() {
      it("throws exception if translation id doesn't exist", function() {
        return expect(function() {
          return translator.trans("");
        }).to.throwError();
      });
      it("throws exception if translation doesn't exist for a given location", function() {
        translator = new FUNDDY.JsTranslations.Translator(intervalParserStub, translationsData, "en");
        return expect(function() {
          return translator.trans("id1");
        }).to.throwError();
      });
      it("translates id", function() {
        return expect(translator.trans("id1")).to.be(IRRELEVANT_TRANSLATION);
      });
      return it("replace parameters correctly", function() {
        return expect(translator.trans("id2", {
          "%parameter%": "test"
        })).to.be("test");
      });
    });
    return describe("#transChoice()", function() {
      var intervalParseShouldReturnAnIntervalThatContainsTheNumber, intervalParseShouldReturnIntervalsThatNeverContainsNumber;
      it("throws exception if number doesn't match multiple choice", function() {
        intervalParseShouldReturnIntervalsThatNeverContainsNumber();
        return expect(function() {
          return translator.transChoice("id3", 1);
        }).to.throwError();
      });
      intervalParseShouldReturnIntervalsThatNeverContainsNumber = function() {
        sinon.stub(dummyInterval, "contains").returns(false);
        return sinon.stub(intervalParserStub, "parse").returns(dummyInterval);
      };
      it("throws exception if number doesn't match multiple choice", function() {
        intervalParseShouldReturnAnIntervalThatContainsTheNumber();
        return expect(translator.transChoice("id3", 0)).to.be("There is no apples");
      });
      return intervalParseShouldReturnAnIntervalThatContainsTheNumber = function() {
        sinon.stub(dummyInterval, "contains").returns(true);
        return sinon.stub(intervalParserStub, "parse").returns(dummyInterval);
      };
    });
  });

}).call(this);
