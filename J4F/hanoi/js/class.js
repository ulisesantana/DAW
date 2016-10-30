/** Disc class
*** constructor options @param = {}
**/
class Disc {
  constructor(options){
    this.width = options.width;
    this.id = options.id;
    this.element = jQuery(`<div id="disc-${options.id}"
                    title="Disc ${options.id}" class="disc"></div>'`);
    this.width = options.width;
    this.margin = options.margin;
    this.height = options.height;
    this.element.css({
      'width': this.width,
      'height': this.height,
      'margin-left': this.margin,
      'margin-right': this.margin
    });
  }

  getDisc(){
    return this.element;
  }
}



/** Stick class
*** constructor id @param = String
**/
class Stick {
  constructor(id) {
    // Alphabet for labeling stick.
    this.alpha = 'ABCDEFG';

    this.discs = [];
    this.label = jQuery(`<div class="stick-label">${this.alpha[id]}</div>`);
    this.id = id + 1;
    this.stick = jQuery(`<div class="stick" id="stick-${this.id}"></div>`);
    this.container = jQuery('<div class="stick-container col-md-4"></div>');
    this.container.append(this.stick);
    this.container.append(this.label);
  }

  getTopDisc(){
      return this.discs.length > 0 ? this.discs[0] : null;
  }

  push(element){
    if (this.discs.length > 0) {
      this.discs.unshift(element);
    } else {
      this.discs.push(element);
    }
  }

  pop(){
    var first = this.discs.shift();
    return first;
  }

  getStickContainer(){
    return this.container;
  }

  getStick(){
    return this.stick;
  }
}


/** Game class
*** constructor options @param = {}
**/
class Game {
  constructor(options) {
    // Default options
    this.options = {
      numOfSticks: 3,
      numOfDiscs: 3,
      container: '#game-container',
      discHeight: 25,
      discMaxWidth: 200,
      destinationStick: 3
    };

    jQuery.extend(this.options, options);

    // Check all invalid options.
    if (this.options.numOfSticks < 3 || this.options.numOfSticks > 7) {
      this.options.numOfSticks = 3;
    }

    if (this.options.destinationStick <= 1 ||
        this.options.destinationStick > this.options.numOfSticks) {
      this.options.destinationStick = this.options.numOfSticks;
    }

    // Current state of the game. Possible values are
    // 'init', 'playing', 'pause', and 'freeze'.
    this.state = 'init';

    // Result of the game. Possible values are 0 for under playing,
    // 1 for win, and -1 for loss.
    this.result = 0;

    // Track total steps performed so far.
    this.steps = 0;

    // Minimum number of steps to win the game.
    this.maxSteps = Math.pow(2, this.options.numOfDiscs) - 1;

    // Holds all stick objects.
    this.sticks = [];

    // Container for the game.
    this.container = jQuery(this.options.container);

    // Save reference for current object.
    var _this = this;

    // Callback after performing step (moving disc between sticks).
    this.afterStep = this.options.afterStep || function(_this) {};
    // Callback onPause
    this.onPause   = this.options.onPause   || function(_this) {};
    // Callback onFreeze
    this.onFreeze  = this.options.onFreeze  || function(_this) {};
    // Callback afterInit
    this.afterInit = this.options.afterInit || function(_this) {};

    this.createSticks();

    // Source stick which all discs will be placed into.
    var sourceStick = this.sticks[0];

    this.createDiscs(sourceStick);

    this.state = 'playing';
    this.afterInit(_this);
  }

  // Create sticks.
  createSticks() {
    for (var i = 0; i < this.options.numOfSticks; i++) {
      this.sticks[i] = new Stick(i);
      this.container.append(this.sticks[i].getStickContainer());

      // Set height based on number of discs.
      this.sticks[i].getStick().css({
        'min-height': this.options.discHeight*this.options.numOfDiscs
      });

      this._bindDroppableToStick(this.sticks[i]);
    }
    // Stylize destination stick.
    this.sticks[this.options.destinationStick-1].
      getStick().parent().addClass('stick-destination');
  }

  // Create discs. Stick object which all discs will be in must be
  // passed as argument.
  createDiscs(sourceStick) {
    for (var i = 0; i < this.options.numOfDiscs; i++) {
      var disc = new Disc({
        id: i+1,
        width: this.options.discMaxWidth - (this.options.numOfDiscs-i)*20,
        height: this.options.discHeight,
        margin: (this.options.numOfDiscs-i)*10
      });

      // Binds draggable into disc.
      this._bindDraggableToDisc(disc);

      // Push into stick.
      // Since this is the first time populating stick
      // with discs, push MUST be directly called from
      // discs property. Subsequent operation should
      // be using push from stick object.
      sourceStick.discs.push(disc);

      // Append disc jQuery object into current stick.
      sourceStick.getStick().append(disc.getDisc());
      disc.getDisc().css('top', i*this.options.discHeight);
    }

    // Copy the height of stick with full stack,
    // so other sticks have same height.
    var idealStickHeight = sourceStick.getStick().height();
    for (var i = 1; i < this.options.numOfSticks; i++) {
      this.sticks[i].getStick().height(idealStickHeight);
    }

    // Enable top disc on first stick.
    var topDisc = sourceStick.getTopDisc().getDisc();
    topDisc.draggable('option', 'disabled', false).addClass('moveable');
  }

  // Bind droppable to stick.
  _bindDroppableToStick(stickObj) {
    // Save reference to object game.
    var _this = this;

    // Droppable handler that sticks have.
    var _stickDroppableHandler = function(e, ui) {
      // All checked conditions should be recorded into
      // new vars rather than checking propery of dynamically changed
      // objects.
      var disc = ui.draggable;
      var disc_id = disc.attr('id');
      var targetStick = jQuery(this);
          targetStick = _this.getStickById(targetStick.attr('id'));
      var isTargetStickEmpty = targetStick.getTopDisc() === null ? true : false;
      var targetStickTopDiscId = !isTargetStickEmpty ?
                               targetStick.getTopDisc().getDisc().attr('id') : null;

      // Calculate the top position for dropped disc.
      var targetStickTopPosition;
      if (!isTargetStickEmpty) {
        targetStickTopPosition = targetStick.getStick().height() -
          (targetStick.discs.length+1)*_this.options.discHeight;
      } else {
        targetStickTopPosition =
          (_this.options.numOfDiscs-1)*_this.options.discHeight;
      }

      disc.draggable('option', 'revert', false);
      // Revert when dropped stick has disc on the top <= current disc.
      if (!isTargetStickEmpty && targetStickTopDiscId <= disc_id) {
        disc.draggable('option', 'revert', true); return;
      }

      // Pop the disc from previous stick and push into new target stick.
      var previousStick = _this.getStickByDiscId(disc.attr('id'));
      targetStick.push(previousStick.pop());

      if (!isTargetStickEmpty) {
        // Put at the top of other sticks.
        targetStick.getStick().prepend(disc);
        disc.css('top', targetStickTopPosition);
      } else {
        // Put at the bottom of the stick.
        targetStick.getStick().append(disc);
        disc.css('top', targetStickTopPosition);
      }

      // Increment steps when disc successfully dropped into new stick.
      _this.steps++;

      for ( let stick in _this.sticks) {
        // Disable dragging to all discs.
        for (let d in _this.sticks[stick].discs) {
          _this.sticks[stick].discs[d].getDisc().draggable(
            'option', 'disabled', true
          ).removeClass('moveable');
        }
        if ( _this.sticks[stick].getTopDisc() !== null ) {
          // Enable draggable for disc on top of the stack.
          _this.sticks[stick].getTopDisc().getDisc().draggable(
            'option', 'disabled', false
          ).addClass('moveable');
        }
      }

      // Executes afterStep callback after disc successfully moved
      // between sticks.
      _this.afterStep(_this);
    }

    stickObj.getStick().droppable({
      hoverClass: 'stick-over',
      drop: _stickDroppableHandler
    });
  }

  // Bind draggable to disc.
  _bindDraggableToDisc (discObj) {
    discObj.getDisc().draggable({
      revert: 'invalid',
      containment: this.container,
      cursor: 'move',
      disabled: true,
      helper: 'clone',
      opacity: 0.35
    });
  }

  // Get stick object given stick element id
  getStickById(attr_id) {
    if (!attr_id) return null;

    var id = attr_id.substring(6) * 1;
    for (var i = 0; i < this.sticks.length; i++) {
      if (this.sticks[i].id == id) return this.sticks[i];
    }
    return null;
  }

  // Get stick object which contains disc with given disc element id
  getStickByDiscId(disc_id) {
    var sticks = this.sticks;
    for (let s in sticks) {
      var discs = sticks[s].discs;
      for (let d in discs) {
        if (disc_id === discs[d].getDisc().attr('id')) {
          return sticks[s];
        }
      }
    }

    return null;
  }

  // Get number of steps player has been moved.
  getSteps() {
    return this.steps;
  }

  // Minimum steps required to win the game.
  getMaxSteps() {
    return this.maxSteps;
  }

  // Checks if the player wins the game.
  // Returns 1 if wins, 0 not yet, and -1
  // for loss.
  isWin() {
    if (this.state !== 'playing') return;

    if (this.steps === this.getMaxSteps()) {
      var dest = this.sticks[this.options.destinationStick-1];
      if (dest.discs.length === this.options.numOfDiscs) {
        this.result = 1;
        return 1;
      }
    } else if (this.steps >= this.getMaxSteps()) {
      if (this.result !== 1) {
        this.result = -1;
        return -1;
      }
      return this.result;
    }
    return 0;
  }

  // Pause the game. Disable all draggable and droppable handlers. To resume the
  // game resume method must be called. The state of the game must be in
  // 'playing'.
  pause() {
    if (this.state !== 'playing') return;

    for (s in this.sticks) {
      for (d in this.sticks[s].discs) {
        var disc = this.sticks[s].discs[d];
        disc.getDisc().draggable('disable');
      }
      this.sticks[s].getStick().droppable('disable');
    }

    this.state = 'pause';

    // callback provided onPause
    this.onPause(this);
  }

  // Resume the game. Enable all droppable handerls to all sticks and draggable
  // handler to all top discs. The state of the game must be in 'pause'.
  resume() {
    if (this.state !== 'pause') return;

    for (s in this.sticks) {
      // enable disc on top of the stick
      if (this.sticks[s].discs.length > 0) {
        var disc = this.sticks[s].discs[0];
        disc.getDisc().draggable('enable');
      }
      // enable the stick
      this.sticks[s].getStick().droppable('enable');
    }

    this.state = 'playing';

    // callback provided onResume
    this.onResume(this);
  }

  // Restart game from the start. It possible to start the game
  // with overriden options.
  restart(options) {
    // Freeze the game.
    if (this.state !== 'freeze') {
      this.freeze();
    }

    // remove all sticks and discs
    for (var i=0; i<this.options.numOfSticks; i++) {
      var stick = this.sticks[i];
      while (stick.discs.length > 0) {
        stick.pop();
      }
    }
    this.sticks = [];
    this.container.html('');

    // Override options.
    options = options || {};
    jQuery.extend(this.options, options);

    // Create new sticks and discs.
    this.createSticks();
    this.createDiscs(this.sticks[0]);

    // Recalculate minumum steps.
    this.maxSteps = Math.pow(2, this.options.numOfDiscs) - 1;

    // Restart internal states.
    this.steps = 0;
    this.result = 0;
    this.state = 'playing';
  }

  // Freeze the game. Destroy all draggable
  // and dropable handlers.
  freeze() {
    if (this.state === 'freeze') return;

    for (s in this.sticks) {
      for (d in this.sticks[s].discs) {
        var disc = this.sticks[s].discs[d];
        disc.getDisc().draggable('destroy').removeClass('moveable');
      }
      this.sticks[s].getStick().droppable('destroy');
    }

    this.state = 'freeze';

    // callback provided onFreeze
    this.onFreeze(this);
  }


}
