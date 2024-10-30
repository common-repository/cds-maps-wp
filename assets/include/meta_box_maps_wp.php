    <div class="cds-maps-wp-box">

      <?php if ( empty( get_option('cds-maps-wp-api') ) ): ?>
         <div class="no-api-key">
           <div>
             <label for="register_api_maps">Enter your API key, if you do not own it, register it <a href="https://developers.google.com/maps/documentation/javascript/get-api-key#quick-guide-to-getting-a-key" target="_blank">here</a></label>
             <input type="text" name="cds-maps-wp-api">
             <button type="button" name="cds-maps-wp-api-save">SAVE</button>
           </div>
         </div>
      <?php endif; ?>

      <div id="tabs">
        <ul>
          <li><a href="#tabs-1">Set Marker</a></li>
          <li><a href="#tabs-2">Advanced</a></li>
          <li><a href="#preview-3">Preview</a></li>
        </ul>
        <div id="tabs-1">
          <h3>Markers</h3>
          <input type="text" id="search-location" placeholder="Search locations">
          <div class="locations"></div>
          <div style="clear:both;"></div>
        </div>
        <div id="tabs-2">
          <h3>Style <small>visit <a target="_blank" href="https://snazzymaps.com/" style="text-decoration:none;">snazzymaps.com</a> and copy json string</small></h3>
          <textarea id="json-style" placeholder="json code....[]"></textarea>
          <h3>Width ( px or % )</h3>
          <input type="text" id="width">
          <h3>Height ( px or % )</h3>
          <input type="text" id="height">
          <h3>Zoom</h3>
          <input type="number" id="zoom">
          <h3>Draggable</h3>
          <label>enable</label>
          <input type="radio" value="true" id="draggable" name="draggable">
          <label>disable</label>
          <input type="radio" value="false" id="draggable" name="draggable">
        </div>
        <div id="preview-3">
            <div id="map_preview" height="150px"></div>
        </div>
      </div><!--#tabs-->
      <div class="results">
        <button type="button" name="button_gen_short_wp-maps-cds">CREATE SHORTCODE</button>
        <code></code>
      </div>
</div>
