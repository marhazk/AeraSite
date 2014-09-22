/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public class MByte extends Rpc.Data
/*    */ {
/*    */   private byte value;
/*    */ 
/*    */   public byte bvalue()
/*    */   {
/* 12 */     return this.value; } 
/* 13 */   public MByte() { this.value = 0; } 
/* 14 */   public MByte(byte v) { this.value = v; }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os) {
/* 17 */     return os.marshal(this.value);
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException {
/* 21 */     this.value = os.unmarshal_byte();
/* 22 */     return os;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.MByte
 * JD-Core Version:    0.6.2
 */