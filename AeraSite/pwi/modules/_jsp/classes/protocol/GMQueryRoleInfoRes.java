/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class GMQueryRoleInfoRes extends Rpc.Data
/*    */ {
/*    */   public int status;
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 18 */     os.marshal(this.status);
/* 19 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 24 */     this.status = os.unmarshal_int();
/* 25 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 32 */       return (GMQueryRoleInfoRes)super.clone();
/*    */     }
/*    */     catch (Exception e) {
/*    */     }
/* 36 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GMQueryRoleInfoRes
 * JD-Core Version:    0.6.2
 */