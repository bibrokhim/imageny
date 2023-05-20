export default class File {
    constructor(props = {}) {
        Object.assign(this, props);
        this.isSelected = false;
    }
}