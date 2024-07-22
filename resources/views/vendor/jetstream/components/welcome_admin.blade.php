   
     
<div class='ui'>
  <div class='ui_box'>
    <div class='ui_box__inner'>
      <h2>
        User Roles
      </h2>
      <p>Number of User Roles in ADS</p>
      <div class='stat'>
        <span>8</span>
      </div>
      <div class='progress'>
        <div class='progress_bar'></div>
      </div>
      <p>8 user roles have been defined for Online-ADS</p>
    </div>
  </div>
</div>

      
<div class='ui'>
  <div class='ui_box'>
    <div class='ui_box__inner'>
      <h2>
        Registered Users By Type
      </h2>
      <p>Total Users Registered</p>
      <div class='stat_left'>
        <ul>
          <li>
            Declarant
          </li>
          <li>
            Agency ADA
          </li>
          <li>
            HOD
          </li>
          <li>
            Commission
          </li>
          <li>
            CADA
          </li>
        </ul>
      </div>
      <div class='progress_graph'>
        <div class='progress_graph__bar--1'></div>
        <div class='progress_graph__bar--2'></div>
        <div class='progress_graph__bar--4'></div>
      </div>
      <p>Users registered in various roles</p>
    </div>
  </div>
</div>

<div class='ui'>      
  <div class='ui_box'>
    <div class='ui_box__inner'>
      <h2>
        Agency Registrations
      </h2>
      <p>Number of Registrations within the Agency</p>
      <div class='stat'>
        <span>93</span>
      </div>
      <div class='progress'>
        <div class='progress_bar--two'></div>
      </div>
      <p>Registrations for the ACC members</p>
    </div>
  </div>
</div>

<div class='ui'>      
  <div class='ui_box'>
    <div class='ui_box__inner'>
      <h2>
        Master Tables
      </h2>
      <p>Number of Master Tables</p>
      <div class='stat'>
        <span>20</span>
      </div>
      <div class='progress'>
        <div class='progress_bar--two'></div>
      </div>
      <p>Total Number of Master Tables</p>
    </div>
  </div>
</div>


<style type="text/css">
@import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600);
body {
  background: #ededeb;
}

body .ui {
  /*width: 900px;*/
  margin: 0 auto;
  margin-top: 20px;
  margin-left: 100px;
  font-family: "Source Sans Pro", sans-serif;
  color: white;
  box-shadow: none;
}
body .ui ul {
  margin: 0px 30px 10px 0px;
  padding: 0;
  list-style-type: none;
  font-size: 11px;
  font-weight: 400;
  line-height: 20px;
}
body .ui .drop {
  z-index: -3;
  opacity: 0;
  width: 240px;
  height: 10px;
  background: #3e8368;
  position: absolute;
  color: white;
  bottom: 0;
  padding: 12px 30px 21px 30px;
  transition-property: bottom, opacity;
  transition-duration: 0.3s;
}
body .ui .drop p {
  color: #f8fbfa;
}
body .ui_box {
  width: 300px;
  height: 220px;
  position: relative;
  background: #3d3d3d;
  float: left;
  box-shadow: -1px 0px rgba(255, 255, 255, 0.07);
  cursor: pointer;
  transform: scale(1);
  transition-property: transform, background;
  transition-duration: 0.3s;
}
body .ui_box__inner {
  padding: 30px;
}
body .ui_box__inner span {
  font-size: 36px;
  font-weight: 700;
}
body .ui_box__inner .progress {
  width: 100%;
  margin-top: 10px;
  height: 6px;
  background: rgba(0, 0, 0, 0.3);
  margin-bottom: 15px;
}
body .ui_box__inner .progress_graph {
  float: right;
  border-bottom: 1px solid rgba(255, 255, 255, 0.09);
  width: 85px;
  text-align: center;
  position: relative;
  padding-left: 20px;
  top: 24px;
}
body .ui_box__inner .progress_graph__bar--1 {
  width: 10px;
  height: 20px;
  background: #4fa584;
  float: left;
  margin-right: 10px;
  position: relative;
  bottom: -10px;
  -webkit-animation: graph 1s;
}
body .ui_box__inner .progress_graph__bar--2 {
  width: 10px;
  -webkit-animation: graph2 1s;
  height: 30px;
  float: left;
  margin-right: 10px;
  background: #4fa584;
}
body .ui_box__inner .progress_graph__bar--3 {
  width: 10px;
  height: 24px;
  margin-right: 10px;
  -webkit-animation: graph3 1s;
  background: #4fa584;
  float: left;
  position: relative;
  bottom: -6px;
}
body .ui_box__inner .progress_graph__bar--4 {
  width: 10px;
  height: 14px;
  -webkit-animation: graph4 1s;
  bottom: -16px;
  position: relative;
  background: #4fa584;
  float: left;
}
body .ui_box__inner .progress_bar {
  height: 6px;
  float: left;
  width: 58%;
  background: #4fa584;
  -webkit-animation: bar 2s;
}
body .ui_box__inner .progress_bar--two {
  height: 6px;
  float: left;
  width: 78%;
  background: #4fa584;
  -webkit-animation: bar2 2s;
}
body .ui_box h2 {
  font-weight: normal;
  font-size: 16px;
  margin: -4px 0px 3px 0px;
}
body .ui_box p {
  font-size: 11px;
  color: #b6b6b6;
  clear: left;
  font-weight: 300;
  width: 160px;
  margin: 2px 0px 15px 0px;
}
body .ui_box:hover {
  background: #4fa584;
  transform: scale(1.1);
  transition-property: transform, background;
  transition-duration: 0.3s;
  position: relative;
  z-index: 1;
}

.ui_box:hover > .ui_box__inner p {
  color: #b3dacb;
}

.ui_box:hover > .drop {
  transition-property: bottom, opacity;
  transition-duration: 0.3s;
  bottom: -42px;
  opacity: 1;
}

.ui_box:hover > .drop .arrow {
  transition-property: transform;
  transition-duration: 1s;
  transform: rotate(765deg);
}

.ui_box:hover > .ui_box__inner .progress_graph > div {
  background: white;
}

.ui_box:hover > .ui_box__inner .progress .progress_bar,
.ui_box:hover > .ui_box__inner .progress .progress_bar--two {
  background: white;
}

.stat_left {
  float: left;
}

.arrow {
  width: 4px;
  height: 4px;
  transition-property: transform;
  transition-duration: 1s;
  transform: rotate(45deg);
  -webkit-transition-timing-function: cubic-bezier(0.68, -0.55, 0.265, 1.55);
  border-top: 1px solid #cdead3;
  border-right: 1px solid #cdead3;
  float: right;
  position: relative;
  top: -24px;
  right: 0px;
}

@-webkit-keyframes bar {
  from {
    width: 0px;
  }
  to {
    width: 58%;
  }
}

@keyframes bar {
  from {
    width: 0px;
  }
  to {
    width: 58%;
  }
}
@-webkit-keyframes bar2 {
  from {
    width: 0px;
  }
  to {
    width: 78%;
  }
}
@keyframes bar2 {
  from {
    width: 0px;
  }
  to {
    width: 78%;
  }
}
@-webkit-keyframes graph {
  from {
    height: 0px;
  }
  to {
    height: 20px;
  }
}
@keyframes graph {
  from {
    height: 0px;
  }
  to {
    height: 20px;
  }
}
@-webkit-keyframes graph2 {
  from {
    height: 0px;
  }
  to {
    height: 30px;
  }
}
@keyframes graph2 {
  from {
    height: 0px;
  }
  to {
    height: 30px;
  }
}
@-webkit-keyframes graph3 {
  from {
    height: 0px;
  }
  to {
    height: 24px;
  }
}
@keyframes graph3 {
  from {
    height: 0px;
  }
  to {
    height: 24px;
  }
}
@-webkit-keyframes graph4 {
  from {
    height: 0px;
  }
  to {
    height: 13px;
  }
}
@keyframes graph4 {
  from {
    height: 0px;
  }
  to {
    height: 13px;
  }
}

</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>