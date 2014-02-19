      <div class="well">
        <? if( $this->get('side_bar') == 'rti_dictionary' ): ?>
            <div>
                <div class="span1">
                  <ul class="nav nav-list bs-docs-sidenav affix-top">
                    <li><a href="#dictionary_a"><i class="icon-chevron-right"></i> A</a></li>
                    <li><a href="#dictionary_b"><i class="icon-chevron-right"></i> B</a></li>
                    <li><a href="#dictionary_c"><i class="icon-chevron-right"></i> C</a></li>
                    <li><a href="#dictionary_d"><i class="icon-chevron-right"></i> D</a></li>
                    <li><a href="#dictionary_e"><i class="icon-chevron-right"></i> E</a></li>
                    <li><a href="#dictionary_f"><i class="icon-chevron-right"></i> F</a></li>
                    <li><a href="#dictionary_g"><i class="icon-chevron-right"></i> G</a></li>
                    <li><a href="#dictionary_h"><i class="icon-chevron-right"></i> H</a></li>
                    <li><a href="#dictionary_i"><i class="icon-chevron-right"></i> I</a></li>
                    <li><a href="#dictionary_j"><i class="icon-chevron-right"></i> J</a></li>
                    <li><a href="#dictionary_k"><i class="icon-chevron-right"></i> K</a></li>
                    <li><a href="#dictionary_l"><i class="icon-chevron-right"></i> L</a></li>
                    <li><a href="#dictionary_m"><i class="icon-chevron-right"></i> M</a></li>
                  </ul>
                </div>
                <div class="span1">
                   <ul class="nav nav-list bs-docs-sidenav affix-top">
                    <li><a href="#dictionary_n"><i class="icon-chevron-right"></i> N</a></li>
                    <li><a href="#dictionary_o"><i class="icon-chevron-right"></i> O</a></li>
                    <li><a href="#dictionary_p"><i class="icon-chevron-right"></i> P</a></li>
                    <li><a href="#dictionary_q"><i class="icon-chevron-right"></i> Q</a></li>
                    <li><a href="#dictionary_r"><i class="icon-chevron-right"></i> R</a></li>
                    <li><a href="#dictionary_s"><i class="icon-chevron-right"></i> S</a></li>
                    <li><a href="#dictionary_t"><i class="icon-chevron-right"></i> T</a></li>
                    <li><a href="#dictionary_u"><i class="icon-chevron-right"></i> U</a></li>
                    <li><a href="#dictionary_v"><i class="icon-chevron-right"></i> V</a></li>
                    <li><a href="#dictionary_w"><i class="icon-chevron-right"></i> W</a></li>
                    <li><a href="#dictionary_x"><i class="icon-chevron-right"></i> X</a></li>
                    <li><a href="#dictionary_y"><i class="icon-chevron-right"></i> Y</a></li>
                    <li><a href="#dictionary_z"><i class="icon-chevron-right"></i> Z</a></li>
                  </ul>
                </div>
                <div style="clear:both"></div>
           </div>
    <?  elseif( $this->get('side_bar') == 'constitution' ): ?>
          

              <ul class="pager">
                <? if($this->get('page_no') < 479 ){ ?>
                    <li class="next">
                      <a href="/constitution/page/<?= intval($this->get('page_no'))+1; ?>">Next &rarr;</a>
                    </li>
                <? } ?>
              <? if( $this->get('page_no') < 479 && $this->get('page_no') > 1  ){ ?>
                  <li class="previous">
                       <a href="/constitution/page/<?= intval($this->get('page_no'))-1; ?>">Previous &rarr;</a>
                  </li>
                <? } ?>
              </ul>

              <p>This book is  one of 1,000 photolithographic reproductions of the Constitution of the Republic of India, which came into effect on January 26, 1950, after being approved by the Constituent Assembly on November 26, 1949. The original of this elaborate edition took nearly five years to produce. It is signed by the framers of the constitution, most of whom are regarded as the founders of the Republic of India. The original of the book is kept in a special helium-filled case in the Library of the Parliament of India. The illustrations represent styles from the different civilizations of the subcontinent, ranging from the prehistoric Mohenjodaro, in the Indus Valley, to the present. The calligraphy in the book was done by Prem Behari Narain Raizda. It was illuminated by Nandalal Bose and other artists, published by Dehra Dun, and photolithographed at the Survey of India Offices.</p>
              Source : <a href="http://www.wdl.org/en/item/2672/">LOC and WDL</a>

    <?  elseif( $this->get('side_bar') == 'rti_faq' ): ?>
          <div class="bs-docs-sidebar">
            <ul class="nav nav-list bs-docs-sidenav affix-top">
              <li><a href="#about_rti_act"><i class="icon-chevron-right"></i> About RTI Act</a></li>
              <li><a href="#rti_application"><i class="icon-chevron-right"></i> RTI Application Process</a></li>
              <li><a href="#appeal_process"><i class="icon-chevron-right"></i> Appeal Process</a></li>
            </ul>
          </div>
    <?  elseif( $this->get('side_bar') == 'faq' ): ?>
          <div class="bs-docs-sidebar">
            <ul class="nav nav-list bs-docs-sidenav affix-top">
              <li><a href="#about"><i class="icon-chevron-right"></i> About</a></li>
              <li><a href="#exploring_ayg"><i class="icon-chevron-right"></i> Exploring AskYourGovt.IN</a></li>
            </ul>
          </div>
    <?  elseif( $this->get('side_bar') == 'rti-act' ): ?>
          <div class="bs-docs-sidebar">
            <h4>Download RTI Act</h4>
            <ul class="nav nav-list bs-docs-sidenav affix-top">
              <li><a href="<?= $this->get('BASE'); ?>/gui/acts/RTIActEnglish.pdf">
                <i class="icon-download-alt"></i> English</a></li>
              <li><a href="<?= $this->get('BASE'); ?>/gui/acts/RTIActKannada.pdf">
                <i class="icon-download-alt"></i> Kannada</a></li>
              <li><a href="<?= $this->get('BASE'); ?>/gui/acts/RTIActHindi.pdf">
                <i class="icon-download-alt"></i> Hindi</a></li>
              <li><a href="<?= $this->get('BASE'); ?>/gui/acts/RTIActBangla.pdf">
                <i class="icon-download-alt"></i> Bangla</a></li>
              <li><a href="<?= $this->get('BASE'); ?>/gui/acts/RTIActGujarati.pdf">
                <i class="icon-download-alt"></i> Gujarati</a></li>
              <li><a href="<?= $this->get('BASE'); ?>/gui/acts/RTIActMalayalam.pdf">
                <i class="icon-download-alt"></i> Malayalam</a></li>
              <li><a href="<?= $this->get('BASE'); ?>/gui/acts/RTIActMarathi.pdf">
                <i class="icon-download-alt"></i> Marathi</a></li>
              <li><a href="<?= $this->get('BASE'); ?>/gui/acts/RTIActUrdu.pdf">
                <i class="icon-download-alt"></i> Urdu</a></li>
              <li><a href="<?= $this->get('BASE'); ?>/gui/acts/RTIActTelugu.pdf">
                <i class="icon-download-alt"></i> Telugu</a></li>
              <li><a href="<?= $this->get('BASE'); ?>/gui/acts/RTIActPunjabi.pdf">
                <i class="icon-download-alt"></i> Punjabi</a></li>
              <li><a href="<?= $this->get('BASE'); ?>/gui/acts/RTIActOriya.pdf">
                <i class="icon-download-alt"></i> Oriya</a></li>
            </ul>
            <h4>Note</h4>
            <p>The Right Information Act, 2005, has been taken from the <a href="http://rti.gov.in/">Govt. of India website</a>. Please go there for any changes or clarification.</p>
          </div>          
    <? else: ?>
            <h4>Search Questions</h4>
            <form class="form-horizontal" method="get" action="/questions">
            <label>Status</label>
            <select name="status" multiple="multiple">
              <option value=1>Asked</option>
              <option value=2>Answered</option>
              <option value=3>Rejected</option>
              <option value=4>Appeal</option>
              <option value=5>Voting</option>
            </select>
            <br/><br/>
            <label>Department</label>
            <select name="dept" multiple="multiple">
              <option value=1>Union Ministry of External Affairs</option>
              <option value=2>Indian Statistical Institute</option>
              <option value=3>Department of Information Technology</option>
              <option value=4>Rashtrapati Bhawan</option>
              <option value=5>Lok Sabha Secretariat</option>
              <option value=6>Union Ministry of Home Affairs</option>
              <option value=7>Ministry of Information and Broadcasting</option>
              <option value=8>Department of Economic Affairs</option>
              <option value=9>IT Department</option>
              <option value=10>UIDAI</option>
              <option value=11>Visvesvaraya Technological University</option>
              <option value=12>Department of Food and Public Distribution</option>
              <option value=13>Election Commision of India</option>
              <option value=15>Prime Minister’s Office</option>
              <option value=16>HCI London</option>
              <option value=17>Ministry of Kannada and Culture</option>
              <option value=18>Hampi University</option>

            </select>
            <br/><br/>
            <button type="submit" class="btn" >Filter</button>
            </form>
        <? endif; ?>      
      </div>
<center>
<span class='st_sharethis_large' displayText='ShareThis'></span>
<span class='st_facebook_large' displayText='Facebook'></span>
<span class='st_twitter_large' displayText='Tweet'></span>
<span class='st_linkedin_large' displayText='LinkedIn'></span>
<span class='st_googleplus_large' displayText='Google +'></span>
<span class='st_email_large' displayText='Email'></span>
</center>


