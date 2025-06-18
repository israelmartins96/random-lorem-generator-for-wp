/**
 * lorempress-dummy-text-generator.js
 * 
 * Generates random dummy text.
 * 
 * NOTE: The plugin uses the minified version of this code located in /wp-content/plugins/lorempress-for-wp/assets/js/.
 * So, any change made to this file would have no effect on the plugin's functionality.
 * To reflect any changes you make to this code, you have to use the Gulp setup. You can see
 * how to configure that in the plugin's development repo: https://github.com/israelmartins96/lorempress-for-wp/
 */

/**
 * Initialises the LoremPress text generator.
 * 
 * Sets up constants, helper functions, and triggers the text generation process.
 */
const initLoremPressGenerator = () => {
    /**
     * @type {string} theParagraph - Stores the generated paragraph.
     */
    let theParagraph;

    /**
     * @type {Array<string>} arrayOfParagraphs - Stores an array of generated paragraphs.
     */
    let arrayOfParagraphs = [];

    /**
     * @type {number} paragraphIndex - Tracks the current index for placing paragraphs into the DOM.
     */
    let paragraphIndex = 0;
    
    /**
     * Configuration constants for text generation.
     */
    const minSentenceWords = 11;
    const maxSentenceWords = 20;
    const minParagraphSentences = 7;
    const maxParagraphSentences = 10;
    
    /**
     * Generates a random floating-point number between 0 (inclusive) and 1 (exclusive).
     * 
     * @returns {number} A random number.
     */
    const randomNumber = () => {
        return Math.random();
    };
    
    /**
     * Generates a random integer between 0 (inclusive) and 9 (inclusive).
     * 
     * @returns {number} A random integer.
     */
    const randomInteger = () => {
        return Math.floor(randomNumber() * 10);
    }
    
    /**
     * Restricts a random integer to be within a specified minimum and maximum range.
     * 
     * @param {number} min - The minimum allowed value.
     * @param {number} max - The maximum allowed value.
     * 
     * @returns {number} A random integer within the specified range.
     */
    const restrictRandomIntegerToRange = (min, max) => {
        return Math.min(Math.max(min, randomInteger()), max);
    };
    
    /**
     * Selects a random array element based on a randomly generated index.
     * 
     * @param {Array<Object>} array - An array of objects.
     * 
     * @returns {Object} A randomly selected object from the array.
     */
    const pickRandomArrayIndex = (array) => {
        const minIndex = 0;
        const maxIndex = array.length - 1;

        /**
         * Get a random index within the bounds of the array length.
         */
        const selectedItemIndex = restrictRandomIntegerToRange(minIndex, maxIndex);

        return array[selectedItemIndex];
    };

    /**
     * Converts a string into an array of words, split by spaces.
     * 
     * @param {string} string - The input string.
     * 
     * @returns {Array<string>} An array of words.
     */
    const convertStringToArray = (string) => {
        return string.split(' ');
    };

    /**
     * Gets the index of the last element in an array.
     * 
     * @param {Array<any>} array - The input array.
     * 
     * @returns {number} The index of the last element.
     */
    const getLastArrayIndex = (array) => {
        const lastArrayIndex = array.length - 1;
        
        return lastArrayIndex;
    };

    /**
     * Generates a random valid index for a given array.
     * 
     * @param {Array<any>} array - The input array.
     * 
     * @returns {number} A random index within the array's bounds.
     */
    const getRandomArrayIndex = (array) => {
        const lastArrayIndex = getLastArrayIndex(array);
        
        return restrictRandomIntegerToRange(0, lastArrayIndex);
    };
    
    /**
     * Determines a random word count for a sentence based on the predefined min/max values.
     * 
     * @returns {number} The random word count for a sentence.
     */
    const pickRandomSentenceWordCount = () => {
        return restrictRandomIntegerToRange(minSentenceWords, maxSentenceWords);
    };
    
    /**
     * Determines a random sentence count for a paragraph based on the predefined min/max values.
     * 
     * @returns {number} The random sentence count for a paragraph.
     */
    const pickRandomSentenceCount = () => {
        return restrictRandomIntegerToRange(minParagraphSentences, maxParagraphSentences);
    };

    /**
     * Capitalises the first letter of a given string.
     * 
     * @param {string} string - The input string.
     * 
     * @returns {string} The string with its first letter capitalized.
     */
    const capitaliseFirstLetter = (string) => {
        /**
         * Handle empty string case.
         */
        if (!string) {
            return '';
        }
        
        return string.charAt(0).toUpperCase() + string.slice(1);
    };

    /**
     * Constructs a random sentence from an array of words.
     * 
     * The sentence will have a random word count and unique words, and will be capitalised and end with a period.
     * 
     * @param {Array<string>} array - The source array of words.
     * 
     * @returns {string} A randomly constructed sentence.
     */
    const constructRandomSentenceFromArray = (arrayOfWords) => {
        let sentenceWords = [];
        let theSentence;
        
        const sentenceWordCount = pickRandomSentenceWordCount();
        
        /**
         * Helper function to get a random index from the main word array.
         * 
         * @returns {number} A random index.
         */
        const arrayIndex = () => {
            return getRandomArrayIndex(arrayOfWords);
        };

        /**
         * Populate sentenceWords with random words until the desired number of words is reached.
         */
        while (sentenceWordCount > sentenceWords.length) {
            sentenceWords.push(arrayOfWords[arrayIndex()]);
        }

        /**
         * Remove duplicate words from the sentence, maintaining order of first appearance.
         */
        sentenceWords.reduce(
            (nonRepeatingArray, arrayItem) => {
                if (nonRepeatingArray.indexOf(arrayItem) === -1) {
                    nonRepeatingArray.push(arrayItem);
                }

                /**
                 * Update sentenceWords to contain only unique words.
                 */
                sentenceWords = nonRepeatingArray;
                return nonRepeatingArray;
            }, []
        );

        /**
         * Join the unique words to form the base sentence.
         */
        theSentence = sentenceWords.join(' ');

        /**
         * Capitalise the first letter of the sentence
         */
        theSentence = capitaliseFirstLetter(theSentence);

        /**
         * Add a period at the end of the sentence.
         */
        theSentence += '.';

        return theSentence;
    };
    
    /**
     * @constant {string} loremPressShortcodeParagraphClass - The CSS class used to identify paragraphs where dummy text should be inserted.
     */
    const loremPressShortcodeParagraphClass = '.lorempress-shortcode-pargraph';

    /**
     * @type {NodeListOf<Element>} loremPressShortcodeParagraphs - A NodeList of all elements matching the shortcode paragraph class.
     */
    const loremPressShortcodeParagraphs = document.querySelectorAll(loremPressShortcodeParagraphClass);
    
    /**
     * Fetches dummy text data, processes it, and generates paragraphs to be inserted into the DOM.
     * 
     * This function is recursive to fill all target paragraphs.
     */
    const generateText = () => {
        const xhr = new XMLHttpRequest();

        /**
         * loremPressData is made globally available via wp_localize_script from the main plugin file (lorempress-for-wp.php).
         * 
         * It contains the base URL for the plugin.
         */
        const baseURL = loremPressData.pluginURL;
        const dataPath = 'assets/data/lorempress-dummy-text-source.json';

        /**
         * Open an asynchronous GET request to the JSON data file.
         */
        xhr.open('GET', baseURL + dataPath, true);

        /**
         * Event handler for when the XMLHttpRequest loads.
         * Processes the response and outputs paragraphs to the DOM.
         */
        xhr.onload = function() {
            /**
             * Check if the request was successful (HTTP status 200 OK).
             */
            if (this.status === 200) {
                /**
                 * Parse the JSON response text.
                 */
                const responseText = JSON.parse(this.responseText);

                /**
                 * Pick a random string of words from the response data.
                 */
                const stringOfWords = pickRandomArrayIndex(responseText).words;

                /**
                 * Convert the string of words into an array of individual words.
                 */
                const arrayOfWords = convertStringToArray(stringOfWords);

                let arrayOfSentences = [];

                /**
                 * Construct sentences until the desired number of sentences is reached.
                 */
                while (arrayOfSentences.length < pickRandomSentenceCount()) {
                    arrayOfSentences.push(constructRandomSentenceFromArray(arrayOfWords));
                }

                /**
                 * Join the sentences to form a paragraph.
                 */
                theParagraph = arrayOfSentences.join(' ');

                /**
                 * Check if there are more target paragraphs than already generated paragraphs.
                 */
                if (loremPressShortcodeParagraphs.length > arrayOfParagraphs.length) {
                    /**
                     * Add the newly generated paragraph to the array of paragraphs.
                     */
                    arrayOfParagraphs.push(theParagraph);
                    
                    /**
                     * Insert the generated paragraph text into the current target paragraph element.
                     */
                    loremPressShortcodeParagraphs[paragraphIndex].innerHTML = arrayOfParagraphs[paragraphIndex];

                    /**
                     * If there are still more paragraphs to generate, increment the index.
                     */
                    if (loremPressShortcodeParagraphs.length > arrayOfParagraphs.length) {
                        paragraphIndex++;
                    }

                    /**
                     * Recursively call generateText to populate the next paragraph.
                     */
                    return generateText();
                }
            }
        };

        /**
         * Send the XMLHttpRequest.
         */
        xhr.send();
    }

    /**
     * Initial call to start the text generation process.
     */
    generateText();
};

/**
 * Trigger the initialization of the LoremPress generator once the entire HTML document has been completely loaded and parsed.
 */
document.addEventListener('DOMContentLoaded', initLoremPressGenerator);