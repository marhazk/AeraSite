/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class UserID extends Rpc.Data
/*    */ {
/*    */   public int id;
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 18 */     os.marshal(this.id);
/* 19 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 24 */     this.id = os.unmarshal_int();
/* 25 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 32 */       return (UserID)super.clone();
/*    */     }
/*    */     catch (Exception e) {
/*    */     }
/* 36 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.UserID
 * JD-Core Version:    0.6.2
 */