let positiveWords = [];
let negativeWords = [];
var table

$(document).ready(function() {

    fetch_list();
    load_table();

    $('#sentiment-form').on('submit', function(event) {
        event.preventDefault();
        let inputText = $('#review_text').val(); // Get the text input
        if (inputText) {
            analyzeSentiment(inputText); // Analyze the sentiment of the input text
        }
    });

});

function load_table(){
  table = $('#sentimentTable').DataTable({
      ajax: {
          url: '/sentiment/data', // The URL to fetch the data
          dataSrc: '' // Adjust this if your JSON response has a different structure
      },
      columns: [{
              data: 'sentiment_text'
          },
          {
              data: 'positive_count'
          },
          {
              data: 'negative_count'
          },
          {
              data: 'sentiment_result'
          },
          {
              data: 'sentiment_score'
          }
      ]
  });
}

function fetch_list() {
    $.ajax({
        type: 'GET',
        url: "/fetch_list",
        dataType: 'json',
        success: function(result) {
            positiveWords = result.positive_list_words;
            negativeWords = result.negative_list_words;
        },
        error: function(error) {
            console.error("Error fetching the word lists", error);
        }
    });
}

function analyzeSentiment(text) {
    let words = text.toLowerCase().match(/\b\w+\b/g); // Convert to lowercase and split into words
    let positiveCount = 0;
    let negativeCount = 0;

    // Loop through each word in the text
    words.forEach(function(word) {
        if (positiveWords.includes(word)) {
            positiveCount++;
        } else if (negativeWords.includes(word)) {
            negativeCount++;
        }
    });

    // Determine sentiment based on counts
    let sentiment = '';
    if (positiveCount > negativeCount) {
        sentiment = 'Positive';
    } else if (negativeCount > positiveCount) {
        sentiment = 'Negative';
    } else {
        sentiment = 'Neutral';
    }

    // Calculate sentiment score dynamically (for example, a range of 0-100)
    let sentiment_score = 0;
    if (positiveCount + negativeCount > 0) {
        sentiment_score = Math.round((positiveCount / (positiveCount + negativeCount)) * 100);
    }


    $('#result-text').text(`Positive: ${positiveCount}, Negative: ${negativeCount}, Sentiment: ${sentiment}`)
    submit_sentiment(text, positiveCount, negativeCount, sentiment, sentiment_score);

}

function submit_sentiment(text, positiveCount, negativeCount, sentiment, sentiment_score) {
    $.ajax({
        method: "POST",
        url: "/add_sentiment",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            'sentiment_text': text,
            'positive_count': positiveCount,
            'negative_count': negativeCount,
            'sentiment_result': sentiment,
            'sentiment_score': sentiment_score,
        },
        dataType: "json",
        cache: false,
        success: function(data) {
            console.log(data);
            table.ajax.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error adding / update data');
        }
    });
}
