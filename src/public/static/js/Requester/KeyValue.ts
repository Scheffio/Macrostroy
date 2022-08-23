export default class KeyValue {
    constructor(public readonly key: string, public readonly value: string, public readonly isFile: boolean = false) {
    }
}