export default class Image {
    constructor(props = {}) {
        Object.assign(this, props);
        this.isSelected = false;
    }
}