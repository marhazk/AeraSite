/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class GPair extends Rpc.Data
/*    */ {
/*    */   public int key;
/*    */   public int value;
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 19 */     os.marshal(this.key);
/* 20 */     os.marshal(this.value);
/* 21 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 26 */     this.key = os.unmarshal_int();
/* 27 */     this.value = os.unmarshal_int();
/* 28 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 35 */       return (GPair)super.clone();
/*    */     }
/*    */     catch (Exception e) {
/*    */     }
/* 39 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GPair
 * JD-Core Version:    0.6.2
 */