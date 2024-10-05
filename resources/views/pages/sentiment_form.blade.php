<h2>Analyze Text Sentiment</h2>
<form id="sentiment-form" class="form">
	@csrf
 <div class="form-group">
     <textarea name="review_text" id="review_text" rows="6" placeholder="Type your review here..."></textarea>
 </div>
 <input type="hidden" name="sentiment_text" id="sentiment_text" value=""/>
 <input type="hidden" name="positive_count" id="positive_count" value=""/>
 <input type="hidden" name="negative_count" id="negative_count" value=""/>
 <input type="hidden" name="sentiment_result" id="sentiment_result" value=""/>
 <input type="hidden" name="sentiment_score" id="sentiment_score" value=""/>

 <button type="submit" class="btn">Analyze Sentiment</button>
</form>

<!-- Display Sentiment Result -->
<div class="results">
   <div id="result-box" class="result-box">
       <p id="result-text" class="result-text"></p>
   </div>
</div>
