/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class PostCreateRoleRes extends Rpc.Data
/*    */ {
/*    */   public int retcode;
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 18 */     os.marshal(this.retcode);
/* 19 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 24 */     this.retcode = os.unmarshal_int();
/* 25 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 32 */       return (PostCreateRoleRes)super.clone();
/*    */     }
/*    */     catch (Exception e) {
/*    */     }
/* 36 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.PostCreateRoleRes
 * JD-Core Version:    0.6.2
 */